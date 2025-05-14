<x-app-layout>



        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="bg-white shadow-md rounded-lg p-4 sm:p-8 mt-10 transform transition duration-300 hover:scale-105 hover:shadow-xl border border-transparent hover:border-[#6B4D1F]">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

    <div class="bg-white shadow-md rounded-lg p-4 sm:p-8 mt-10 transform transition duration-300 hover:scale-105 hover:shadow-xl border border-transparent hover:border-[#6B4D1F]">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

    <div class="bg-white shadow-md rounded-lg p-4 sm:p-8 mt-10 transform transition duration-300 hover:scale-105 hover:shadow-xl border border-transparent hover:border-[#6B4D1F]">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    </x-app-layout>
