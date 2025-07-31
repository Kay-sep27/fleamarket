public function rules(): array
{
    return [
        'name' => ['required'],
        'price' => ['required', 'numeric', 'min:0'],
        'description' => ['required', 'max:120'],
        'image' => ['nullable', 'image', 'mimes:jpeg,png'],
    ];
}