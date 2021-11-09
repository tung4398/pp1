/* add background gradient */
const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const titleInfos = $$('.showrooms__info .info__location')

titleInfos.forEach((titleInfo) => {
    titleInfo.onclick = function() {
        $('.info__location.info__location--active').classList.remove('info__location--active');
        // console.log(this);
        this.classList.add('info__location--active');
    }
})
/* add page-item active */
const pages = $$('.page-item')

pages.forEach((page) => {
    page.onclick = function() {
        $('.page-item.active').classList.remove('active');
        // console.log(this);
        this.classList.add('active');
    }
})

/* add cate-choice active */
const cate_choices = $$('.category-box-choice')

cate_choices.forEach((cate_choice) => {
    cate_choice.onclick = function() {
        if($('.category-box-choice.choice-active')) {
            $('.category-box-choice.choice-active').classList.remove('choice-active');
        }
        // console.log(this);
        this.classList.add('choice-active');
    }
})

/* scroll */
const body = $('body')
const wrapper = $('.wrapper')
const header = $('.header')
const headerTop = $('.header__top')
const headerLogo = $('.header-logo')
const u_a_i_first = $('.user-action-item--first')
const selectionScroll = $('.selection-scroll')
const uaList = $('.user-action-list')
const sellLinks = $$('.sell__link')
const selections = $$('.selection')
const newsInfo = $$('.news__info')
const buildPCs = $$('.build-pcs')

const scrollToTopBtn = $('#btn_scroll-top');
var rootElement = document.documentElement;
scrollToTopBtn.onclick = function() {
    rootElement.scrollTo({
        top: 0,
        behavior: "smooth"
    })
    
}
document.onscroll  = function() {
    const scrollTop = window.scrollY || document.documentElement.scrollTop
    // console.log(scrollTop);

    if(scrollTop > 800) {
        body.style.margin = "200px 0 0 0"
        header.style.position = "fixed"
        wrapper.style.display = "flex"
        wrapper.style.flexDirection = "row-reverse"
        headerTop.classList.add("hide")
        headerLogo.classList.add("hide")
        u_a_i_first.classList.add("hide")
        uaList.style.padding = "0px"
        sellLinks.forEach((sellLink) => {
            sellLink.classList.add("hide")
        })
        selections.forEach((selection) => {
            selection.classList.add("hide")
        })
        newsInfo.forEach((item) => {
            item.classList.add("hide")
        })
        buildPCs.forEach((buildPC) => {
            buildPC.classList.add("hide")
        })
        selectionScroll.classList.add("show")
        scrollToTopBtn.classList.add("show")
    }
    else {
        body.style.margin = "0"
        wrapper.style.display = "block"
        header.style.position = "static"
        headerTop.classList.remove("hide")
        headerLogo.classList.remove("hide")
        u_a_i_first.classList.remove("hide")
        uaList.style.padding = "10px"
        sellLinks.forEach((sellLink) => {
            sellLink.classList.remove("hide")
        })
        selections.forEach((selection) => {
            selection.classList.remove("hide")
        })
        newsInfo.forEach((item) => {
            item.classList.remove("hide")
        })
        buildPCs.forEach((buildPC) => {
            buildPC.classList.remove("hide")
        })
        selectionScroll.classList.remove("show")
        scrollToTopBtn.classList.remove("show")
    }
}