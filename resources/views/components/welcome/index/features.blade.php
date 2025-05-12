<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Powerful Features for Learning</h2>
            <p class="text-slate-600 max-w-2xl mx-auto">Our platform provides everything you need to create engaging quizzes and enhance the learning experience.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {features.map((feature, index) => (
            <Card key={index} class="border border-slate-200 shadow-sm hover:shadow-md transition-all">
                <CardHeader class="pb-2">
                    <div class="bg-edu-light/50 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                        {feature.icon}
                    </div>
                    <CardTitle class="text-xl">{feature.title}</CardTitle>
                </CardHeader>
                <CardContent>
                    <p class="text-slate-600">{feature.description}</p>
                </CardContent>
            </Card>
            ))}
        </div>
    </div>
</section>