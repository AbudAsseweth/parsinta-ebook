<x-app-layout title="{{ $user->name }}">
    <x-header title="{{ $user->name }}" subtitle="{{ '@' . $user->username }}">
        Joined {{ $user->created_at?->format('d F, Y') }}
    </x-header>
    <div class="container">
        <x-articles :articles="$articles" />
    </div>
</x-app-layout>
