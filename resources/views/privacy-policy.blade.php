<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy | DreyCoding School</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-800">

    <div class="min-h-screen w-full">
        <div class="mx-auto max-w-5xl px-4 py-12 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-10 text-center">
                <a href="{{ url('/') }}" class="inline-flex items-center justify-center gap-2">
                    <img
                        src="https://res.cloudinary.com/dxp2nia6s/image/upload/v1776687647/1002774238-removebg-preview_thfrai.png"
                        alt="DreyCoding School Logo"
                        class="h-14 w-auto"
                    >
                </a>

                <h1 class="mt-6 text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Privacy Policy
                </h1>
                <p class="mt-3 text-sm text-gray-600 sm:text-base">
                    Last Updated: April 2026
                </p>
            </div>

            {{-- Content --}}
            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:p-8 lg:p-10">
                <div class="prose prose-gray max-w-none">
                    <p>
                        At <strong>DreyCoding School</strong> ("we", "our", or "us"), we value your privacy
                        and are committed to protecting your personal information. This Privacy Policy explains
                        how we collect, use, disclose, and safeguard your information when you visit our website
                        and use our services.
                    </p>

                    <h2>1. Information We Collect</h2>
                    <p>We may collect the following types of information:</p>

                    <h3>Personal Information</h3>
                    <ul>
                        <li>Name</li>
                        <li>Email address</li>
                        <li>Phone number</li>
                        <li>Billing or payment-related details</li>
                        <li>Any information you provide when registering for a course or contacting us</li>
                    </ul>

                    <h3>Non-Personal Information</h3>
                    <ul>
                        <li>Browser type</li>
                        <li>Device information</li>
                        <li>IP address</li>
                        <li>Pages visited on our website</li>
                        <li>Time spent on pages</li>
                        <li>Referral source</li>
                    </ul>

                    <h2>2. How We Use Your Information</h2>
                    <p>We use the information we collect to:</p>
                    <ul>
                        <li>Provide access to our courses and services</li>
                        <li>Process registrations and payments</li>
                        <li>Communicate with you about your account, courses, and updates</li>
                        <li>Improve our website, content, and user experience</li>
                        <li>Respond to inquiries and provide support</li>
                        <li>Comply with legal obligations</li>
                    </ul>

                    <h2>3. Cookies and Tracking Technologies</h2>
                    <p>
                        We may use cookies and similar tracking technologies to improve your browsing experience,
                        analyze traffic, and understand how visitors use our site. You can disable cookies through
                        your browser settings, but some parts of the website may not function properly.
                    </p>

                    <h2>4. Google AdSense and Advertising</h2>
                    <p>
                        We may use Google AdSense or other advertising services to display ads on our website.
                        These third-party vendors may use cookies to serve ads based on your prior visits to this
                        website or other websites.
                    </p>
                    <p>
                        Google may use the <strong>DoubleClick cookie</strong> to enable it and its partners to
                        serve ads based on your visit to our site and/or other sites on the internet.
                    </p>
                    <p>
                        You may opt out of personalized advertising by visiting Google Ads Settings.
                    </p>

                    <h2>5. Third-Party Services</h2>
                    <p>We may use trusted third-party services such as:</p>
                    <ul>
                        <li>Payment processors such as Paystack</li>
                        <li>Website analytics tools</li>
                        <li>Cloud storage and media services</li>
                        <li>Advertising platforms</li>
                    </ul>
                    <p>
                        These third-party services may collect, store, and process your data according to their own
                        privacy policies. We encourage you to review their privacy practices.
                    </p>

                    <h2>6. Data Sharing</h2>
                    <p>
                        We do not sell, rent, or trade your personal information to third parties. However, we may
                        share your information where necessary to:
                    </p>
                    <ul>
                        <li>Provide our services effectively</li>
                        <li>Process payments</li>
                        <li>Comply with legal obligations</li>
                        <li>Protect our rights, users, or platform</li>
                    </ul>

                    <h2>7. Data Security</h2>
                    <p>
                        We implement reasonable technical and organizational measures to protect your personal
                        information. However, no system is completely secure, and we cannot guarantee absolute security.
                    </p>

                    <h2>8. Your Rights</h2>
                    <p>Depending on your location, you may have the right to:</p>
                    <ul>
                        <li>Request access to your personal data</li>
                        <li>Request correction of inaccurate information</li>
                        <li>Request deletion of your data</li>
                        <li>Withdraw consent where applicable</li>
                    </ul>

                    <h2>9. Children’s Privacy</h2>
                    <p>
                        Our website and services are not directed to children under the age of 13. We do not knowingly
                        collect personal information from children under 13.
                    </p>

                    <h2>10. Changes to This Privacy Policy</h2>
                    <p>
                        We may update this Privacy Policy from time to time. Any changes will be posted on this page
                        with a revised effective date.
                    </p>

                    <h2>11. Contact Us</h2>
                    <p>
                        If you have any questions about this Privacy Policy or how we handle your information,
                        you can contact us through the details below:
                    </p>

                    <ul>
                        <li><strong>Website:</strong> {{ url('/') }}</li>
                        <li><strong>Email:</strong> support@dreycodingschool.com.ng</li>
                    </ul>

                    <p>
                        By using our website, you agree to the terms of this Privacy Policy.
                    </p>
                </div>
            </div>

            {{-- Footer links --}}
            <div class="mt-8 text-center">
                <a href="{{ url('/') }}" class="text-sm font-medium text-purple-700 hover:underline">
                    ← Back to Home
                </a>
            </div>

        </div>
    </div>

</body>
</html>