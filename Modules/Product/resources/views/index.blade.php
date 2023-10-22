<x-app-layout :data="$head ?? []">
    <h1>Hello World</h1>

    <p>
        Module: {!! config('product.name') !!}
    </p>
</x-app-layout>
