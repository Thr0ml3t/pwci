<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <form method="POST">
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="title"
                                       class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                <div class="mt-2">
                                    <input value="<?= $noteTitle ?? '' ?>" type="text" name="title" id="title"
                                           autocomplete="given-name"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <p class="text-red-600 font-weight-bold hidden" id="titleError">
                                    </p>
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="note" class="block text-sm font-medium leading-6 text-gray-900">Note</label>
                                <div class="mt-2">
                                    <textarea id="note" name="note" rows="3"
                                              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $noteBody ?? '' ?></textarea>
                                    <p class="text-red-600 font-weight-bold hidden" id="bodyError">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <a href="/notes" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                    <button type="button" onclick="sendForm()"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Save
                    </button>
                </div>
            </form>

        </div>
    </main>

    <script>
        function sendForm() {
            let title = document.getElementById('title');
            let body = document.getElementById('note');

            const formBody = {
                title: title.value,
                note: body.value
            };

            fetch('http://localhost:8000/notes', {
                method: 'POST',
                body: JSON.stringify(formBody)
            }).then((response) => {
                if (!response.ok) {
                    throw response
                }
                return response.json()
            }).then((response) => {
                Swal.fire({
                    icon: "success",
                    text: response.msg,
                });

                title.value = ''
                body.value = ''

                document.getElementById('titleError').innerHTML = '';
                document.getElementById('bodyError').innerHTML = '';
                document.getElementById('titleError').classList.add('hidden');
                document.getElementById('bodyError').classList.add('hidden');
            }).catch(async (error) => {
                const errorResponse = await error.json();
                if (errorResponse) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: errorResponse.msg,
                    });

                    if (errorResponse.errors.hasOwnProperty('title')) {
                        let titleErrorContainer = document.getElementById('titleError');

                        titleErrorContainer.innerHTML = errorResponse.errors.title;
                        titleErrorContainer.classList.remove('hidden');
                    }

                    if (errorResponse.errors.hasOwnProperty('body')) {
                        let titleErrorContainer = document.getElementById('bodyError');

                        titleErrorContainer.innerHTML = errorResponse.errors.body;
                        titleErrorContainer.classList.remove('hidden');
                    }
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                }
            }).then(() => {
                console.log('termino');
            })
        }
    </script>
<?php require base_path('views/partials/footer.php') ?>