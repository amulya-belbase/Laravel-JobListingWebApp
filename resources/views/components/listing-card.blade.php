@props(['listing'])

{{-- For the main Listing page (Display All listings) --}}

<x-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            {{-- Ternary operator to see if the comanpy logo exists, if it does, display it or else display the no-image from default folder --}}
            src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png')}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="/listings/{{$listing->id}}">{{$listing->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
            <x-listing-tag :tagsCsv='$listing->tags' />   {{--  passing tags as props to listing-tag component --}}
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
            </div>
        </div>
    </div>
</x-card>
