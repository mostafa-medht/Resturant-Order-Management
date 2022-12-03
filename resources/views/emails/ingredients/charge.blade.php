<x-mail::message>
# Hello

This email to notify you with your ingredient status.

    Your stock level : {{ $ingredient->level_of_stock  }}
    Your available stock : {{ $ingredient->quantity }}

    Low level of ingredient quantity, you should charge your ingredient.

<x-mail::button :url="''">
Check Ingredient
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
