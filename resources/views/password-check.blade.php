<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900">Password Check Tool</h2>
                <p class="mt-1 text-sm text-gray-600">This tool helps diagnose login issues.</p>

                <div id="result" class="mt-4 p-4 bg-gray-100 rounded-lg hidden">
                    <pre id="response" class="text-sm"></pre>
                </div>

                <form id="password-check-form" class="mt-6">
                    @csrf
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button type="button" id="check-button">
                            {{ __('Check Password') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('check-button').addEventListener('click', function() {
            const form = document.getElementById('password-check-form');
            const formData = new FormData(form);
            
            fetch('/check-password', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('response').textContent = JSON.stringify(data, null, 2);
                document.getElementById('result').classList.remove('hidden');
            })
            .catch(error => {
                document.getElementById('response').textContent = error;
                document.getElementById('result').classList.remove('hidden');
            });
        });
    </script>
</x-guest-layout>
