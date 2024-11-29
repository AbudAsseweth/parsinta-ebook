<x-app-layout title="Articles">
    <x-header title="Articles">
        @slot('subtitle')
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores eum totam laboriosam at magnam sit recusandae
            laborum nobis quod temporibus.
        @endslot
    </x-header>
    <div class="container">
        <x-articles :articles="$articles" />
    </div>
</x-app-layout>
