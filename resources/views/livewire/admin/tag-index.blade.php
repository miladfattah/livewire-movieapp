<div class="w-full mx-auto">

	<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
		<div class="p-4 flex justify-between items-center">
            <div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input wire:model="search" type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                </div>
                <div class="flex justify-between mt-4">
                    <p class="font-medium">Filters</p>
    
                    <button wire:click="resetFilters"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md">Reset
                        Filter</button>
                </div>
    
                <div>
                    <div class="flex justify-between space-x-4 mt-4">
                        <select wire:model="sort"
                            class="px-4 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">
                            <option value="asc">Asc</option>
                            <option value="desc">Desc</option>
                        </select>
    
                        <select wire:model="perPage"
                            class="px-4 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">
                            <option value="5">5 Per Page</option>
                            <option value="10">10 Per Page</option>
                            <option value="15">15 Per Page</option>
                        </select>
                    </div>
                </div>
            </div>
            <x-jet-button wire:click="showModal">Create</x-jet-button>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    
                    <th scope="col" class="px-6 py-3">
                        Tag
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Slug
                    </th>
                    <th scope="col" class="px-6 py-3">
                       
                    </th>
                </tr>
            </thead>
            <tbody>
                
                @forelse ($tags as $tag)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" wire:key="key-{{$tag->id}}-index">
                    <td class="px-6 py-4">
                        {{$tag->tag_name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$tag->slug}}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button wire:click="editModal({{$tag->id}})" class="px-2 py-1 text-xs text-white bg-orange-500 rounded-md focus:bg-orange-600 focus:outline-none">Edit</button>
                        <button wire:click="deleteTag({{$tag->id}})" class="px-2 py-1 text-xs text-white bg-red-500 rounded-md focus:bg-red-600 focus:outline-none">Delete</button>
                    </td>
                   @empty
                    <td class="px-6 py-4">
                        Empty
                    </td>
                </tr>
                @endforelse
                
            </tbody>
        </table>
    </div>
    <x-jet-dialog-modal wire:model="modal">
        <x-slot name="title">
            <div class="text-center">
                <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200">Tag</h1>
                <p class="text-gray-400 dark:text-gray-400">Fill up the form below to send us a message.</p>
            </div>
        </x-slot>
        <x-slot name="content">

            <div class="flex items-center w-full ">
                <div class="w-full">
                    <div class="max-w-md mx-auto my-10 bg-white p-5 rounded-md shadow-sm">
                     
                        <div class="m-7">
                            <form>
                                <div class="mb-6">
                                    <label for="name" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Tag Name</label>
                                    <input wire:model="tag_name" type="text" id="name"  class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                                </div>
                                {{-- <div class="mb-6">
                                    <label for="message" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Your Message</label>
                                    <textarea rows="5" name="message" id="message" placeholder="Your Message" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" required></textarea>
                                </div> --}}
                                <div class="mb-6">
                                    <button wire:click="closeModal" type="button" class="px-3 py-2 text-white bg-yellow-500 rounded-md focus:bg-yellow-600 focus:outline-none">Cancel</button>
                                    @if ($tag_id)
                                        <button wire:click="updateTag" type="button" class="px-3 py-2 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">Update</button>
                                        @else
                                        <button wire:click="createTag" type="button"  class="px-3 py-2 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">Create</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">Footer</x-slot>
    </x-jet-dialog-modal>
</div>