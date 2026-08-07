/**
 * Reading Progress Bar & Single Article Interactions for Bhaiyyantop
 */

document.addEventListener('DOMContentLoaded', function() {
    // 1. Reading Progress Bar Indicator
    const progressBar = document.getElementById('readingProgressBar');
    const articleContainer = document.querySelector('.single-post-content');

    if (progressBar && articleContainer) {
        window.addEventListener('scroll', function() {
            const articleTop = articleContainer.offsetTop;
            const articleHeight = articleContainer.offsetHeight;
            const windowHeight = window.innerHeight;
            const scrollTop = window.scrollY;

            if (scrollTop >= articleTop) {
                const totalScrollable = articleHeight - windowHeight + articleTop;
                let progress = ((scrollTop - articleTop) / totalScrollable) * 100;
                progress = Math.min(100, Math.max(0, progress));
                progressBar.style.width = progress + '%';
            } else {
                progressBar.style.width = '0%';
            }
        });
    }

    // 2. Copy Share Link Handler
    const copyBtn = document.getElementById('copyShareLinkBtn');
    if (copyBtn) {
        copyBtn.addEventListener('click', function() {
            const linkToCopy = this.getAttribute('data-link') || window.location.href;
            navigator.clipboard.writeText(linkToCopy).then(function() {
                const originalIcon = copyBtn.innerHTML;
                copyBtn.innerHTML = '<i class="fa fa-check"></i>';
                alert('लिंक क्लिपबोर्ड पर कॉपी हो गया!');
                setTimeout(function() {
                    copyBtn.innerHTML = originalIcon;
                }, 2000);
            }).catch(function(err) {
                console.error('Copy link failed: ', err);
            });
        });
    }

    // 3. Back To Top Floating Button
    const backToTopBtn = document.createElement('button');
    backToTopBtn.id = 'backToTopBtn';
    backToTopBtn.setAttribute('aria-label', 'Back to top');
    backToTopBtn.innerHTML = '<i class="fa fa-arrow-up"></i>';
    document.body.appendChild(backToTopBtn);

    window.addEventListener('scroll', function() {
        if (window.scrollY > 400) {
            backToTopBtn.classList.add('visible');
        } else {
            backToTopBtn.classList.remove('visible');
        }
    });

    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});
