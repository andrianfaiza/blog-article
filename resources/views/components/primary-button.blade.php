<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full h-10 bg-blue-600 font-bold text-white']) }}>
    {{ $slot }}
</button>
