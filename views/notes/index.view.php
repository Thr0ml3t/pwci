<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <p class="mb-6">
                <a href="/notes/create"
                   class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    New Note
                </a>
            </p>

            <ul role="list" class="divide-y divide-gray-100">
                <?php foreach ($notes as $note): ?>
                    <li class="p-3 hover:bg-indigo-100">
                        <a href="/note?id=<?= $note['id'] ?>" class="flex justify-between gap-x-6 py-5">
                            <div class="flex min-w-0 gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900"><?= htmlspecialchars($note['title']) ?></p>
                                    <p class="mt-1 truncate text-xs leading-5 text-gray-500 truncate">
                                        <?= htmlspecialchars($note['note']) ?>
                                    </p>
                                </div>
                            </div>
                            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                <p class="mt-1 text-xs leading-5 text-gray-500">Created
                                    <time datetime="2023-01-23T13:23Z">3h ago</time>
                                </p>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </main>
<?php require base_path('views/partials/footer.php') ?>