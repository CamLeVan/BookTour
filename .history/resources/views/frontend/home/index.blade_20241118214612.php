<x-frontend-layout>
    <!-- Header Video -->
    <x-frontend.home.header />

    <!-- Search Form -->
    <x-frontend.home.search />

    <!-- About Section -->
    <x-frontend.home.about />

    <!-- Popular Tours -->
    <x-frontend.home.tours :tours="$tours" />

    <!-- Numbers/Stats Section -->
    <x-frontend.home.numbers />

    <!-- Popular Destinations -->
    <x-frontend.home.destinations :destinations="$destinations" />

    <!-- Testimonials -->
    <x-frontend.home.testimonials :testimonials="$testimonials" />

    <!-- Clients/Partners -->
    <x-frontend.home.clients />
</x-frontend-layout>