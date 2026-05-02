<?php

namespace MyVendor\Blog\Command;

use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;
use MyVendor\Blog\Domain\Repository\PostRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class BlogCleanupCommand extends Command
{
    public function __construct(private readonly PostRepository $postRepository, private readonly PersistenceManagerInterface $persistenceManager) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Cleanup old blog posts')->addOption('days', null, InputOption::VALUE_REQUIRED, 'Number of days', 5); // default to 5 days
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $days = (int)$input->getOption('days');

        $dateThreshold = new \DateTime();
        $dateThreshold->modify('-' . $days . ' days');

        $posts = $this->postRepository->findAll();

        $deletedCount = 0;
        foreach ($posts as $post) {
            $postDate = $post->getDate();

            if (!$postDate) {
                continue;
            }

            if ($postDate < $dateThreshold) {
                $this->postRepository->remove($post);
                $output->writeln('Deleted: ' .$post->getTitle(). ' | Date: ' . $postDate->format('Y-m-d'));
                $deletedCount++;
            }
        }
        $this->persistenceManager->persistAll();
        $output->writeln('Total deleted posts: ' . $deletedCount);
        return Command::SUCCESS;
    }
}