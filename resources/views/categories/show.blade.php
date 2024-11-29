<x-app-layout title="Articles category: {{ $category->name }}">
    <x-header :title="$category->name" subtitle="This page will show all articles by {{ $category->name }} category">
    </x-header>
    <div class="container">
        <x-articles :articles="$articles" />
    </div>
</x-app-layout>
