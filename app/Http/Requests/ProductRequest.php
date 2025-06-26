<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                'min:3',
                'regex:/^[\p{L}\p{N}\s\-\.\,\(\)]+$/u' // Hỗ trợ Unicode (tiếng Việt), số, khoảng trắng và ký tự đặc biệt
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000'
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
                'max:999999999'
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:2048', // 2MB
                'dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000'
            ],
            'image_url' => [
                'nullable',
                'url',
                'regex:/^https?:\/\/.+\.(jpg|jpeg|png|gif|webp)$/i'
            ]
        ];

        // Nếu đang update, cho phép tên trùng với chính nó
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $productId = $this->route('product')->id ?? null;
            $rules['name'][] = 'unique:products,name,' . $productId;
        } else {
            $rules['name'][] = 'unique:products,name';
        }

        return $rules;
    }

    /**
     * Get custom validation messages
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.min' => 'Tên sản phẩm phải có ít nhất 3 ký tự.',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'name.unique' => 'Tên sản phẩm đã tồn tại.',
            'name.regex' => 'Tên sản phẩm chứa ký tự không hợp lệ.',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự.',
            'price.required' => 'Giá sản phẩm là bắt buộc.',
            'price.numeric' => 'Giá sản phẩm phải là số.',
            'price.min' => 'Giá sản phẩm không được âm.',
            'price.max' => 'Giá sản phẩm quá lớn.',
            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, webp.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 2MB.',
            'image.dimensions' => 'Kích thước hình ảnh phải từ 100x100 đến 2000x2000 pixels.',
            'image_url.url' => 'Đường dẫn hình ảnh không hợp lệ.',
            'image_url.regex' => 'URL hình ảnh phải có định dạng: jpg, jpeg, png, gif, webp.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Sanitize input data
        $this->merge([
            'name' => strip_tags($this->name),
            'description' => strip_tags($this->description),
            'price' => is_numeric($this->price) ? (float) $this->price : $this->price,
            'image_url' => $this->image_url ? trim($this->image_url) : null,
        ]);
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Ensure only one image source is provided
            if ($this->hasFile('image') && $this->filled('image_url')) {
                $validator->errors()->add('image', 'Chỉ được chọn một trong hai: upload file hoặc nhập URL.');
                $validator->errors()->add('image_url', 'Chỉ được chọn một trong hai: upload file hoặc nhập URL.');
            }
        });
    }
}
