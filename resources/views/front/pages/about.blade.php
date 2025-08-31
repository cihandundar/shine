@extends('front.base')

@section('title', 'About Us - Shine Blog')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-purple-600 to-blue-600 text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-6">About Shine</h1>
        <p class="text-xl md:text-2xl mb-8 text-purple-100">
            Empowering voices, sharing knowledge, and building a community of learners
        </p>
    </div>
</section>

<!-- Mission Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-8">Our Mission</h2>
            <p class="text-lg text-gray-600 leading-relaxed mb-8">
                At Shine, we believe in the power of knowledge sharing and community building. 
                Our platform serves as a bridge between passionate writers and curious readers, 
                creating a space where ideas flourish and insights are shared.
            </p>
            <p class="text-lg text-gray-600 leading-relaxed">
                We strive to provide a high-quality content platform that educates, inspires, 
                and connects people from all walks of life through meaningful articles and stories.
            </p>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Our Values</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                The principles that guide everything we do
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-lightbulb text-3xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Innovation</h3>
                <p class="text-gray-600">
                    We constantly explore new ways to improve our platform and enhance the user experience.
                </p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-users text-3xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Community</h3>
                <p class="text-gray-600">
                    Building strong connections between writers and readers is at the heart of what we do.
                </p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-star text-3xl text-purple-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Quality</h3>
                <p class="text-gray-600">
                    We maintain high standards for content quality and user experience.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Our Team</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Meet the dedicated people behind Shine
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-user text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Development Team</h3>
                <p class="text-gray-600 text-sm">
                    Building and maintaining our platform with cutting-edge technology
                </p>
            </div>

            <div class="text-center">
                <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-pen text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Content Team</h3>
                <p class="text-gray-600 text-sm">
                    Curating and managing high-quality content for our readers
                </p>
            </div>

            <div class="text-center">
                <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-paint-brush text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Design Team</h3>
                <p class="text-gray-600 text-sm">
                    Creating beautiful and intuitive user interfaces
                </p>
            </div>

            <div class="text-center">
                <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-headset text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Support Team</h3>
                <p class="text-gray-600 text-sm">
                    Providing excellent customer service and support
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-8">Get in Touch</h2>
            <p class="text-lg text-gray-600 mb-8">
                Have questions or suggestions? We'd love to hear from you!
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Email</h3>
                    <p class="text-gray-600">info@shine.com</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Phone</h3>
                    <p class="text-gray-600">+90 555 123 45 67</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marker-alt text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Location</h3>
                    <p class="text-gray-600">Istanbul, Turkey</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
