@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-semibold mb-4">Contact Us</h1>
        <p class="mb-2">Contact me ✉️✉️ <strong>@iamfuad1</strong></p>
        <p class="mb-2">🏷 Phone: <strong>+251 914 075 870</strong></p>
        <p class="mb-2">📍 Location: ቦሌ መድሀንያአለም High School ፊት ለፊት, BATI COMPLEX or Dasy Hotel, Ground Floor</p>
        <p class="mb-2">Shop No: <strong>018</strong></p>
        <p class="mb-2">🏷️ Share ለወዳጅ ዘመዶ ያጋሩ</p>
        <p class="mb-2">Telegram: <a href="https://t.me/Numberonebrandfashion" class="text-blue-600 hover:underline">@Numberonebrandfashion</a></p>
        <p class="mb-2">TikTok: <a href="https://www.tiktok.com/@numberonebrand1" class="text-blue-600 hover:underline">@numberonebrand1</a></p>
        <p class="mt-6">Address: አዲስ አበባ ቦሌ ኤድናሞል አደባባይ ፊት ለፊት, BATI COMPLEX, Ground Floor, Shop No. 018</p>

        <!-- Communication Form -->
        <form method="POST" action="{{ url('/contact') }}" class="mt-8 max-w-xl mx-auto">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Send Message</button>
        </form>
    </div>
@endsection
