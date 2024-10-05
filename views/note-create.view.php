<?php require 'partials/head.php' ?>
<?php require 'partials/nav.php' ?>
<?php require 'partials/banner.php' ?>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <form method="POST">
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                <div class="mt-2">
                                    <input value="<?= $noteTitle??'' ?>" type="text" name="title" id="title" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <p class="text-red-600 font-weight-bold">
                                        <?= isset($errors['title']) ? $errors['title'] : '' ?>
                                    </p>
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="note" class="block text-sm font-medium leading-6 text-gray-900">Note</label>
                                <div class="mt-2">
                                    <textarea id="note" name="note" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $noteBody??'' ?></textarea>
                                    <p class="text-red-600 font-weight-bold">
                                        <?= isset($errors['body']) ? $errors['body'] : '' ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    <button type="button" onclick="sendForm()" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function sendForm(){
            let title = document.getElementById('title').value;
            let body = document.getElementById('note').value;

            const formBody = {
              title: title,
              note: body
            };

            fetch('wwqq/note/create',{
                method: 'POST',
                body: JSON.stringify(formBody)
            }).then((response) => {
                return response.json()
            }).then((response) => {
                console.log(response);
            }).catch(() => {
                console.log('error');
            }).then(() => {
                console.log('termino');
            })
        }
    </script>
<?php require 'partials/footer.php' ?>