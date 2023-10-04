<x-layout>
@include('partials._hero')
@include('partials._search')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lesss Gooooo</title>
</head>
<body>
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @if(count($listings) == 0)
            <p>No listings found</p>
        @endif
        @foreach ($listings as $listing)
            <x-listing-card :listing="$listing" />  {{-- passing props to listing card page, to display all listings --}}
        @endforeach
    </div>
    <div class="mt-6 p-4">
        {{$listings->links()}}
    </div>
</body>
</html>
</x-layout>