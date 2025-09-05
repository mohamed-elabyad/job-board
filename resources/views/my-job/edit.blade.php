<x-layout>
    <x-breadcrumbs class="mb-4" :links="['My Jobs' => route('my-jobs.index'), 'Edit' => '#']" />
    <x-card class="mb-8">
        <form action="{{route('my-jobs.update', $job)}}" method="POST">
            @csrf
            @method("PUT")

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <x-label for="title" required='true' >Title</x-label>
                    <x-text-input name='title' id="title" :value="$job->title" placeholder="Job's title..."/>
                </div>
                <div>
                    <x-label for="location" required='true' >Location</x-label>
                    <x-text-input name='location' id="location" :value="$job->location" placeholder="Job's Location..." />
                </div>
                <div  class="col-span-2">
                    <x-label for="salary" required='true' >Salary</x-label>
                    <x-text-input name='salary' id="salary" :value="$job->salary" placeholder="Job's salary..." />
                </div>
                <div class="col-span-2">
                    <x-label for="description" required='true' >Description</x-label>
                    <x-text-input type="textarea" name='description' :value="$job->description" id="description" placeholder="Job's description..." />
                </div>

                <div>
                    <x-label for="experience" required="true">Experience</x-label>
                    <x-radio-group name="experience" :value="$job->experience" :options="\App\Models\Job::$experience" />
                </div>
                <div>
                    <x-label for="category" required="true">Category</x-label>
                    <x-radio-group name="category" :value="$job->category" :options="\App\Models\Job::$category" />
                </div>

                <div class="col-span-2">
                    <x-button class="w-full">Edit Job</x-button>
                </div>
            </div>
        </form>
    </x-card>
</x-layout>
