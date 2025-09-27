<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Blog Generator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#5D5CDE',
                    }
                }
            }
        }
    </script>
    <style>
        .blog-post {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .image-loading {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        .dark .image-loading {
            background: linear-gradient(90deg, #374151 25%, #4b5563 50%, #374151 75%);
            background-size: 200% 100%;
        }
    </style>
</head>
<body class="bg-white dark:bg-gray-900 transition-colors duration-300">
    <!-- Header -->
    <header class="bg-primary text-white shadow-lg">
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-3xl font-bold text-center">Random Blog Generator</h1>
            <p class="text-center mt-2 text-purple-100">Discover amazing content with random beautiful images</p>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="bg-gray-100 dark:bg-gray-800 shadow-sm">
        <div class="container mx-auto px-4 py-3">
            <div class="flex flex-wrap gap-2 justify-center">
                <button onclick="filterPosts('all')" class="filter-btn bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-purple-700 transition-colors">All Posts</button>
                <button onclick="filterPosts('technology')" class="filter-btn bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">Technology</button>
                <button onclick="filterPosts('travel')" class="filter-btn bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">Travel</button>
                <button onclick="filterPosts('lifestyle')" class="filter-btn bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">Lifestyle</button>
                <button onclick="filterPosts('food')" class="filter-btn bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">Food</button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Generate Button -->
        <div class="text-center mb-8">
            <button onclick="generateNewPost()" class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-purple-700 transition-colors shadow-lg">
                Generate New Post
            </button>
        </div>

        <!-- Loading State -->
        <div id="loading" class="hidden text-center py-8">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Generating amazing content...</p>
        </div>

        <!-- Blog Posts Grid -->
        <div id="blog-posts" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-800 mt-12">
        <div class="container mx-auto px-4 py-6 text-center text-gray-600 dark:text-gray-400">
            <p>&copy; 2024 Random Blog Generator. Built with HTML, CSS & JavaScript.</p>
        </div>
    </footer>

    <script>
        // Dark mode detection
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
            if (event.matches) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });

        // Blog post data
        const blogPosts = [];
        let currentFilter = 'all';

        // Sample content data
        const contentTemplates = {
            technology: [
                {
                    title: "The Future of Artificial Intelligence",
                    content: "Artificial Intelligence is revolutionizing the way we work, live, and interact with technology. From machine learning algorithms that can predict market trends to neural networks that can create art, AI is opening up possibilities we never imagined. As we stand on the brink of a new technological era, it's important to understand both the opportunities and challenges that lie ahead.",
                    tags: ["AI", "Technology", "Future"]
                },
                {
                    title: "Cybersecurity in the Digital Age",
                    content: "With the increasing digitization of our lives, cybersecurity has become more critical than ever. From protecting personal data to securing corporate networks, understanding the fundamentals of digital security is essential. This post explores the latest trends in cybersecurity and practical steps you can take to protect yourself online.",
                    tags: ["Security", "Digital", "Privacy"]
                },
                {
                    title: "The Rise of Quantum Computing",
                    content: "Quantum computing represents a paradigm shift in computational power. Unlike classical computers that use bits, quantum computers use quantum bits or qubits, which can exist in multiple states simultaneously. This technology promises to solve complex problems that are currently impossible for traditional computers.",
                    tags: ["Quantum", "Computing", "Innovation"]
                }
            ],
            travel: [
                {
                    title: "Hidden Gems of Southeast Asia",
                    content: "Southeast Asia is full of incredible destinations that go beyond the typical tourist trail. From pristine beaches in remote islands to ancient temples hidden in dense jungles, this region offers endless opportunities for adventure. Discover lesser-known destinations that will take your breath away and create memories to last a lifetime.",
                    tags: ["Asia", "Adventure", "Culture"]
                },
                {
                    title: "Solo Travel: A Journey of Self-Discovery",
                    content: "Traveling alone can be one of the most rewarding experiences of your life. It pushes you out of your comfort zone, helps you develop independence, and allows you to truly connect with local cultures. Learn how to plan safe and enjoyable solo adventures that will change your perspective on the world.",
                    tags: ["Solo Travel", "Adventure", "Growth"]
                },
                {
                    title: "Sustainable Tourism for the Modern Traveler",
                    content: "As travelers become more conscious of their environmental impact, sustainable tourism has gained significant importance. From choosing eco-friendly accommodations to supporting local communities, there are many ways to travel responsibly while still having amazing experiences.",
                    tags: ["Sustainability", "Eco-Travel", "Responsible"]
                }
            ],
            lifestyle: [
                {
                    title: "The Art of Minimalist Living",
                    content: "Minimalism isn't just about having fewer possessions; it's about focusing on what truly matters in life. By decluttering our physical and mental spaces, we can create room for more meaningful experiences and relationships. Discover how embracing minimalism can lead to greater happiness and fulfillment.",
                    tags: ["Minimalism", "Wellness", "Lifestyle"]
                },
                {
                    title: "Building Healthy Morning Routines",
                    content: "How you start your morning sets the tone for your entire day. A well-crafted morning routine can boost productivity, improve mental health, and increase overall life satisfaction. Learn how to design a morning routine that works for your lifestyle and helps you achieve your goals.",
                    tags: ["Productivity", "Health", "Habits"]
                },
                {
                    title: "The Power of Mindfulness in Daily Life",
                    content: "In our fast-paced world, practicing mindfulness has become essential for mental well-being. Mindfulness helps us stay present, reduce stress, and appreciate the small moments that make life beautiful. Explore simple techniques to incorporate mindfulness into your daily routine.",
                    tags: ["Mindfulness", "Mental Health", "Peace"]
                }
            ],
            food: [
                {
                    title: "Exploring Global Street Food Culture",
                    content: "Street food offers an authentic taste of local culture and tradition. From Thai pad thai served from roadside stalls to Mexican tacos from food trucks, street food represents the heart and soul of culinary traditions. Join us on a global journey to discover the most delicious street foods from around the world.",
                    tags: ["Street Food", "Culture", "Global Cuisine"]
                },
                {
                    title: "The Farm-to-Table Movement",
                    content: "The farm-to-table movement has transformed how we think about food. By connecting directly with local farmers and producers, restaurants and home cooks alike are rediscovering the importance of fresh, seasonal ingredients. Learn about the benefits of eating locally and how to incorporate farm-fresh foods into your diet.",
                    tags: ["Farm-to-Table", "Local Food", "Sustainability"]
                },
                {
                    title: "Plant-Based Cooking for Beginners",
                    content: "Plant-based cooking has gained incredible popularity for its health benefits and environmental impact. Whether you're considering a fully plant-based diet or just want to incorporate more vegetables into your meals, this guide will help you create delicious and nutritious plant-based dishes that everyone will love.",
                    tags: ["Plant-Based", "Healthy Eating", "Recipes"]
                }
            ]
        };

        // Generate random post
        function generateRandomPost() {
            const categories = Object.keys(contentTemplates);
            const randomCategory = categories[Math.floor(Math.random() * categories.length)];
            const categoryPosts = contentTemplates[randomCategory];
            const randomPost = categoryPosts[Math.floor(Math.random() * categoryPosts.length)];
            
            const imageId = Math.floor(Math.random() * 1000) + 1;
            const imageUrl = `https://picsum.photos/400/250?random=${imageId}`;
            
            return {
                id: Date.now() + Math.random(),
                category: randomCategory,
                title: randomPost.title,
                content: randomPost.content,
                tags: randomPost.tags,
                image: imageUrl,
                author: getRandomAuthor(),
                date: getRandomDate(),
                readTime: Math.floor(Math.random() * 8) + 4
            };
        }

        function getRandomAuthor() {
            const authors = ['Alex Johnson', 'Sarah Chen', 'Michael Rodriguez', 'Emma Thompson', 'David Kim', 'Lisa Park', 'James Wilson', 'Maria Garcia'];
            return authors[Math.floor(Math.random() * authors.length)];
        }

        function getRandomDate() {
            const days = Math.floor(Math.random() * 30) + 1;
            const date = new Date();
            date.setDate(date.getDate() - days);
            return date.toLocaleDateString();
        }

        // Create post HTML
        function createPostHTML(post) {
            return `
                <article class="blog-post bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300" data-category="${post.category}">
                    <div class="relative">
                        <img src="${post.image}" alt="${post.title}" class="w-full h-48 object-cover image-loading" loading="lazy">
                        <div class="absolute top-4 left-4">
                            <span class="bg-primary text-white px-2 py-1 rounded-full text-xs font-medium capitalize">${post.category}</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-3 hover:text-primary transition-colors cursor-pointer">${post.title}</h2>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">${post.content}</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            ${post.tags.map(tag => `<span class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded text-xs">#${tag}</span>`).join('')}
                        </div>
                        <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex items-center space-x-2">
                                <div class="w-6 h-6 bg-primary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    ${post.author.charAt(0)}
                                </div>
                                <span>${post.author}</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span>${post.date}</span>
                                <span>${post.readTime} min read</span>
                            </div>
                        </div>
                    </div>
                </article>
            `;
        }

        // Generate new post
        async function generateNewPost() {
            const loading = document.getElementById('loading');
            const postsContainer = document.getElementById('blog-posts');
            
            loading.classList.remove('hidden');
            
            // Simulate loading time
            await new Promise(resolve => setTimeout(resolve, 1000));
            
            const newPost = generateRandomPost();
            blogPosts.unshift(newPost);
            
            // Add new post to the beginning
            const postElement = document.createElement('div');
            postElement.innerHTML = createPostHTML(newPost);
            postsContainer.insertBefore(postElement.firstElementChild, postsContainer.firstElementChild);
            
            loading.classList.add('hidden');
            
            // Apply current filter
            filterPosts(currentFilter);
        }

        // Filter posts
        function filterPosts(category) {
            currentFilter = category;
            const posts = document.querySelectorAll('.blog-post');
            const filterBtns = document.querySelectorAll('.filter-btn');
            
            // Update button styles
            filterBtns.forEach(btn => {
                btn.classList.remove('bg-primary', 'text-white');
                btn.classList.add('bg-gray-200', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
            });
            
            event.target.classList.remove('bg-gray-200', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
            event.target.classList.add('bg-primary', 'text-white');
            
            // Filter posts
            posts.forEach(post => {
                if (category === 'all' || post.dataset.category === category) {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            });
        }

        // Initialize blog with some posts
        function initializeBlog() {
            const postsContainer = document.getElementById('blog-posts');
            
            // Generate initial posts
            for (let i = 0; i < 6; i++) {
                const post = generateRandomPost();
                blogPosts.push(post);
                postsContainer.innerHTML += createPostHTML(post);
            }
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', initializeBlog);
    </script>
</body>
</html>