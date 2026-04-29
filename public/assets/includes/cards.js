Livewire.hook('morph.updated', () => {
    $(".selectpickerJs").selectpicker("destroy");
    $(".selectpickerJs").selectpicker();
});

document.addEventListener('livewire:init', () => {
    $(".selectpickerJs").selectpicker("destroy");
    $(".selectpickerJs").selectpicker();
});
