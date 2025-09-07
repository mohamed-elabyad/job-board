<x-layout>
    <x-breadcrumbs class="mb-4" :links="['jobs' => route('jobs.index')]" />

    <form action="{{route('jobs.index')}}" method="GET">
        <x-card class="mb-4 text-sm " >
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input name="search" id="search" value="{{request('search')}}" placeholder="Search for any text" />
                </div>
            <div>
                <div class="mb-1 font-semibold">Salary</div>

                <div class="flex space-x-2">
                <x-text-input name="min_salary" id="min_salary" value="{{request('min_salary')}}" placeholder="From" />
                <x-text-input name="max_salary" id="max_salary" value="{{request('max_salary')}}" placeholder="To" />
                </div>
            </div>

            <div>
                <div class="mb-1 font-semibold">Experience</div>

                <x-radio-group name="experience" allOption='true' :options="\App\Enums\OfferedJobsExperienceEnum::values()" />
            </div>

            <div>
                <div class="mb-1 font-semibold">Category</div>

                <x-radio-group name="category" allOption='true' :options="\App\Enums\OfferedJobsCategoryEnum::values()" />
            </div>

        </div>

            <x-button class="w-full">Filter</x-button>
        </x-card>

    </form>

  @foreach ($jobs as $job)
        <x-job-card :$job>
            <div>
                <x-link-button href="{{route('jobs.show', $job)}}" >
                    Show</x-link-button>
            </div>
        </x-job-card>
    @endforeach
</x-layout>
