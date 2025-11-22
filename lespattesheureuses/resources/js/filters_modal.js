const buttonFilters = document.getElementById('button_filters');
const template = document.getElementById('template');
const content = template.content.cloneNode(true);
let templateInjected = false;
const search_specie = document.getElementById('no_js_search_specie');


search_specie.classList.remove('hidden');
buttonFilters.classList.remove('hidden');
buttonFilters.classList.add('button_filters');

buttonFilters.addEventListener('click', (e) => {
    e.preventDefault();
})

const basic_div = document.getElementById('filters');
const dialog_element = document.createElement('dialog');


[...basic_div.attributes].forEach(attribute => {

    dialog_element.setAttribute(attribute.name, attribute.value);
});


while (basic_div.firstChild) {
    dialog_element.appendChild(basic_div.firstChild);
}

basic_div.replaceWith(dialog_element);


buttonFilters.addEventListener('click', (e) => {
    dialog_element.showModal();
    document.body.classList.add('no-scroll');
    if (!templateInjected) {
        const content = template.content.cloneNode(true);
        dialog_element.appendChild(content);
        templateInjected = true;
    }
});


const basics = document.querySelectorAll('[class*="basic"]');

basics.forEach(basic => {
    basic.classList.forEach(cls => {
        if (cls === 'basic') {
            basic.classList.replace('basic', 'dialog-element');
        } else if (cls.startsWith('basic__') || cls.startsWith('basic--')) {
            const newClass = cls.replace('basic', 'dialog-element');
            basic.classList.replace(cls, newClass);
        }
    });
});

dialog_element.addEventListener('click', (e) => {
    if (e.target === dialog_element) {
        dialog_element.close();
    }
});

dialog_element.addEventListener('close', () => {
    document.body.classList.remove('no-scroll');
});
