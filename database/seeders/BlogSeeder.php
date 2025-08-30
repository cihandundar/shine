<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Author;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kategorileri oluştur
        $categories = [
            'Technology',
            'Health',
            'Education',
            'Sports',
            'Art',
            'Science',
            'Lifestyle',
            'Economy',
            'Travel',
            'Food'
        ];

        foreach ($categories as $categoryName) {
            Category::firstOrCreate(
                ['name' => $categoryName],
                [
                    'name' => $categoryName,
                    'slug' => \Illuminate\Support\Str::slug($categoryName),
                    'description' => 'Articles related to ' . $categoryName
                ]
            );
        }

        // Blog yazıları
        $blogs = [
            [
                'title' => 'Artificial Intelligence and Our Future',
                'content' => 'Artificial intelligence technologies are rapidly developing today and entering every area of our lives. Developments in areas such as machine learning, deep learning, and natural language processing are deeply affecting the business world and society. In this article, we will discuss how artificial intelligence will affect us in the future and how we will cope with this technology.',
                'excerpt' => 'Discover how artificial intelligence technologies will change our lives in the future.',
                'status' => 'published',
                'category_id' => 1
            ],
            [
                'title' => '10 Golden Rules for Healthy Living',
                'content' => 'Healthy living is not just about preventing diseases, but also feeling good physically and mentally. Basic elements such as regular exercise, balanced nutrition, adequate sleep, and stress management form the foundation of a healthy life. In this article, we will share 10 practical rules that you can apply in your daily life.',
                'excerpt' => 'Learn healthy living rules that you can apply in your daily life.',
                'status' => 'published',
                'category_id' => 2
            ],
            [
                'title' => 'Advantages and Disadvantages of Distance Education',
                'content' => 'Distance education, which spread rapidly during the pandemic period, caused major changes in the education sector. Thanks to technology, students can now receive education from anywhere in the world. However, this system has both advantages and disadvantages. In this article, we will examine the pros and cons of distance education in detail.',
                'excerpt' => 'We analyze the advantages and disadvantages of distance education in detail.',
                'status' => 'published',
                'category_id' => 3
            ],
            [
                'title' => 'Evolution of Football Tactics',
                'content' => 'Football is not just a sport, but also a strategy game that constantly evolves. Tactics such as tiki-taka, gegenpressing, and catenaccio show the historical development of football. In modern football, the use of data analysis and technology has completely changed the tactical development processes. In this article, we will examine how football tactics have evolved and what might happen in the future.',
                'excerpt' => 'Discover the historical development of football tactics and changes in modern football.',
                'status' => 'published',
                'category_id' => 4
            ],
            [
                'title' => 'Great Masters of Renaissance Art',
                'content' => 'The Renaissance period is one of the most important periods in art history. Great masters such as Leonardo da Vinci, Michelangelo, and Raphael left unforgettable works to humanity during this period. Works such as the Mona Lisa, the Sistine Chapel, and the School of Athens are still admired today. In this article, we will examine the great masters of Renaissance art and their works in detail.',
                'excerpt' => 'Discover the great artists and unforgettable works of the Renaissance period.',
                'status' => 'published',
                'category_id' => 5
            ],
            [
                'title' => 'The Mysterious World of Quantum Physics',
                'content' => 'Quantum physics is a branch of science that studies the behavior of subatomic particles, challenging the rules of classical physics. Concepts such as superposition, entanglement, and the uncertainty principle present results that contradict our daily experiences. In this article, we will explain the basic concepts of quantum physics and how they affect our daily lives.',
                'excerpt' => 'Learn the mysterious world of quantum physics and its basic concepts.',
                'status' => 'published',
                'category_id' => 6
            ],
            [
                'title' => 'Benefits of Minimalist Lifestyle',
                'content' => 'Minimalist lifestyle is not just about reducing physical items, but also simplifying our lives and focusing on what is important. This approach reduces stress, creates more time, and increases happiness. In this article, we will discuss the benefits of minimalist lifestyle and how to apply it in detail.',
                'excerpt' => 'Discover the benefits of minimalist lifestyle and how to apply it.',
                'status' => 'published',
                'category_id' => 7
            ],
            [
                'title' => 'The Future of Cryptocurrency Economy',
                'content' => 'Cryptocurrencies have the potential to fundamentally change the traditional financial system. Bitcoin, Ethereum, and other cryptocurrencies form the foundation of a decentralized financial system. In this article, we will analyze the current state of the cryptocurrency ecosystem, its future potential, and opportunities for investors.',
                'excerpt' => 'We analyze the current state and future potential of the cryptocurrency economy.',
                'status' => 'published',
                'category_id' => 8
            ],
            [
                'title' => 'The Most Beautiful Cities in the World',
                'content' => 'There are countless cities around the world, each with their own unique beauties. The romantic atmosphere of Paris, the modern structure of Tokyo, the canals of Venice, the energy of New York... In this article, we will introduce the most beautiful cities in the world and places that must be seen in these cities. This article, which serves as a guide for travel enthusiasts, will help you shape your plans.',
                'excerpt' => 'Discover the most beautiful cities in the world and places that must be seen.',
                'status' => 'published',
                'category_id' => 9
            ],
            [
                'title' => 'Delights of Traditional Turkish Cuisine',
                'content' => 'Turkish cuisine is a culinary tradition recognized worldwide for its thousands of years of history and cultural richness. Delicacies such as various kebabs, pide, lahmacun, manti, and baklava form only a part of Turkish cuisine. In this article, we will examine the most popular dishes of traditional Turkish cuisine, their recipes, and historical origins in detail.',
                'excerpt' => 'Learn the most delicious dishes and recipes of traditional Turkish cuisine.',
                'status' => 'published',
                'category_id' => 10
            ]
        ];

        // Create author
        $author = Author::firstOrCreate(
            ['email' => 'admin@shine.com'],
            [
                'name' => 'Admin Author',
                'email' => 'admin@shine.com',
                'bio' => 'Experienced writer with expertise in various topics',
                'is_active' => true
            ]
        );

        // Create blog posts
        foreach ($blogs as $blogData) {
            $blog = Blog::create([
                'title' => $blogData['title'],
                'content' => $blogData['content'],
                'excerpt' => $blogData['excerpt'],
                'status' => $blogData['status'],
                'author_id' => $author->id,
                'published_date' => now(),
            ]);

            // Establish category relationship
            $blog->categories()->attach($blogData['category_id']);
        }
    }
}
