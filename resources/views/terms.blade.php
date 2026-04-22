<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditions | DreyCoding School</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-800">

<div class="mx-auto max-w-5xl px-4 py-12">

    {{-- Header --}}
    <div class="text-center mb-10">
        <a href="{{ url('/') }}">
            <img src="https://res.cloudinary.com/dxp2nia6s/image/upload/v1776687647/1002774238-removebg-preview_thfrai.png"
                 class="h-14 mx-auto mb-4">
        </a>

        <h1 class="text-3xl font-bold">Terms & Conditions</h1>
        <p class="text-sm text-gray-500 mt-2">Last Updated: April 2026</p>
    </div>

    {{-- Content --}}
    <div class="bg-white rounded-3xl p-8 shadow-sm ring-1 ring-gray-200 space-y-6">

        <p>
            Welcome to <strong>DreyCoding School</strong>. By accessing and using our website,
            you agree to comply with the following terms and conditions.
        </p>

        <h2 class="text-xl font-semibold">1. Acceptance of Terms</h2>
        <p>
            By using this website, you agree to be bound by these Terms and Conditions.
            If you do not agree, please do not use our services.
        </p>

        <h2 class="text-xl font-semibold">2. Services</h2>
        <p>
            DreyCoding School provides online coding education, training, and related services.
            We reserve the right to modify or discontinue any service at any time.
        </p>

        <h2 class="text-xl font-semibold">3. User Responsibilities</h2>
        <ul class="list-disc ml-6">
            <li>Provide accurate information during registration</li>
            <li>Maintain the confidentiality of your account</li>
            <li>Use the platform responsibly and legally</li>
        </ul>

        <h2 class="text-xl font-semibold">4. Payments & Refunds</h2>
        <p>
            All payments are processed securely through third-party providers such as Paystack.
            Fees paid for courses are generally non-refundable unless otherwise stated.
        </p>

        <h2 class="text-xl font-semibold">5. Intellectual Property</h2>
        <p>
            All content on this website, including videos, materials, and code,
            belongs to DreyCoding School and must not be copied or redistributed without permission.
        </p>

        <h2 class="text-xl font-semibold">6. Limitation of Liability</h2>
        <p>
            We are not liable for any direct or indirect damages arising from the use of our website or services.
        </p>

        <h2 class="text-xl font-semibold">7. Privacy</h2>
        <p>
            Your use of our services is also governed by our Privacy Policy.
        </p>

        <h2 class="text-xl font-semibold">8. Termination</h2>
        <p>
            We reserve the right to suspend or terminate your access if you violate these terms.
        </p>

        <h2 class="text-xl font-semibold">9. Changes to Terms</h2>
        <p>
            We may update these Terms at any time. Continued use of the platform means you accept the changes.
        </p>

        <h2 class="text-xl font-semibold">10. Contact</h2>
        <p>
            For any inquiries, contact us at:
            <br>
            <strong>Email:</strong> support@dreycodingschool.com.ng
        </p>

    </div>

    {{-- Footer --}}
    <div class="text-center mt-8">
        <a href="{{ url('/') }}" class="text-sm text-purple-600 hover:underline">
            ← Back to Home
        </a>
    </div>

</div>

</body>
</html>