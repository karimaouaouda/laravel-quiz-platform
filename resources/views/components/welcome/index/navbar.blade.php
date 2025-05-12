<nav class="bg-white shadow-sm border-b border-slate-200">
    <div class="container mx-auto flex justify-between items-center py-4">
        <a href="/" class="flex items-center space-x-2">
        <div class="bg-edu-primary rounded-full w-8 h-8 flex items-center justify-center text-white font-bold">
            Q
        </div>
        <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-edu-primary to-edu-secondary">QuizMaster</span>
        </a>

        <div class="hidden md:flex space-x-4 items-center">
            <a href="{{ route('quizzes') }}" class="text-slate-600 hover:text-edu-primary transition-colors">
            Browse Quizzes
            </a>
            <a href="/about" class="text-slate-600 hover:text-edu-primary transition-colors">
            About
            </a>
            <a href="/contact" class="text-slate-600 hover:text-edu-primary transition-colors">
            Contact
            </a>
            <a href="/" class="flex">
            <button variant="outline" class="border-edu-primary text-edu-primary hover:bg-edu-light">
                Login
            </button>
            </a>
        </div>

        <div class="md:hidden">
            {/* Mobile menu button could go here */}
            <button variant="ghost" size="sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" class="lucide lucide-menu">
                    <line x1="4" x2="20" y1="12" y2="12" />
                    <line x1="4" x2="20" y1="6" y2="6" />
                    <line x1="4" x2="20" y1="18" y2="18" />
                </svg>
            </button>
        </div>
    </div>
</nav>