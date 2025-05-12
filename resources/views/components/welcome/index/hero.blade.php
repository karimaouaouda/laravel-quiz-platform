<div class="hero-gradient py-16 md:py-24">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-start">
            <div class="md:w-1/2 mb-10 md:mb-0 md:pr-10 md:pt-8">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-edu-dark to-edu-primary">
                    Create and take quizzes with ease
                </h1>
                <p class="text-lg md:text-xl text-slate-700 mb-8">
                    A powerful platform that allows teachers to create engaging quizzes and students to learn through interactive assessment.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <button size="lg" class="bg-edu-primary hover:bg-edu-primary/90 text-white font-medium">
                        Get Started
                    </button>
                    <a href=/quizzes">
                    <button size="lg" variant="outline" class="border-edu-primary text-edu-primary hover:bg-edu-light">
                        Browse Quizzes
                    </button>
                    </a>
                </div>
                <div class="mt-6 flex items-center text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" class="text-edu-accent mr-2">
                        <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2z" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                    <span class="text-sm">Get started in less than 5 minutes</span>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <div class="w-full max-w-md">
                    <div class="mb-6 rounded-lg overflow-hidden shadow-lg">
                        <img
                            src="https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?auto=format&fit=crop&w=800&q=80"
                            alt="Students taking a quiz"
                            class="w-full h-auto rounded-lg object-cover" />
                    </div>
                    <RoleSelector />
                </div>
            </div>
        </div>
    </div>
</div>