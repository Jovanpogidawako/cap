<article>
    <!-- #HERO -->
    <section class="section hero" id="home">
        <div class="container">
            
            <!-- Greeting message with fade-in animation -->
            <div class="hero-content fade-in">
                <h2>
                    <?php if (isset($user['name'])): ?>
                        Welcome, <?= esc($user['name']) ?>
                    <?php else: ?>
                        Welcome to Our Service
                    <?php endif; ?>
                </h2>
                <p class="hero-text fade-in-delayed">The easy way to takeover a lease</p>
            </div>

            <!-- Title with slide-in animation -->
            <div class="hero-content fade-in-delayed">
                <h2 class="h1 hero-title slide-up">BROOM BROOM!!</h2>
            </div>

            <!-- Smoothly appearing banner image -->
            <div class="hero-banner slide-up-delayed"></div>
                
            <!-- Animated form -->
            <form action="" class="hero-form fade-in-delayed">
                <a href="/carslist" class="btn scale-in" aria-labelledby="aria-label-txt">
                    <span id="aria-label-txt">Explore cars</span>
                </a>
            </form>
        </div>

    </section>
</article>
