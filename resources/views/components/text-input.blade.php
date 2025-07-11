@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-accent/30 bg-background text-text focus:border-accent focus:ring-accent rounded-md shadow-sm']) }}>
