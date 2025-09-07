<x-layout>
    <x-breadcrumbs class="mb-4" :links="['My Jobs' => route('my-jobs.index'), 'Create' => '#']" />
    <x-card class="mb-8">
        <form action="{{route('my-jobs.store')}}" method="POST">
            @csrf

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <x-label for="title" required='true' >Title</x-label>
                    <x-text-input name='title' id="title" value="{{old('title')}}" placeholder="Job's title..."/>
                </div>
                <div>
                    <x-label for="location" required='true' >Location</x-label>
                    <x-text-input name='location' id="location" value="{{old('location')}}" placeholder="Job's Location..." />
                </div>
                <div  class="col-span-2">
                    <x-label for="salary" required='true' >Salary</x-label>
                    <x-text-input name='salary' id="salary" value="{{old('salary')}}" placeholder="Job's salary..." />
                </div>
                <div class="col-span-2">
                    <x-label for="description" required='true' >Description</x-label>
                    <x-text-input type="textarea" name='description' value="{{old('description')}}" id="description" placeholder="Job's description..." />
                </div>

                <div>
                    <x-label for="experience" required="true">Experience</x-label>
                    <x-radio-group name="experience" value="{{old('experience')}}" :options="\App\Enums\OfferedJobsExperienceEnum::values()" />
                </div>
                <div>
                    <x-label for="category" required="true">Category</x-label>
                    <x-radio-group name="category" value="{{old('category')}}" :options="\App\Enums\OfferedJobsCategoryEnum::values()" />
                </div>

                <div class="col-span-2">
                    <x-button class="w-full">Create Job</x-button>
                </div>
            </div>
        </form>
    </x-card>
</x-layout>
