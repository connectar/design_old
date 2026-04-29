<div>
    <div class="box border-success m-0">
        <div class="box-body py-0">
            <div class="row">
                <div class="col-md-12 my-2">
                    <div class="box border-success bg-dark m-0">
                        <div class="box-body text-center">
                            <h5 class="card-title text-primary">
                                تخصيص الأعمدة في لوحة النظام
                            </h5>
                            <p class="text-gray mt-2">
                                يمكنك ترتيب الأعمدة الظاهرة في لوحة التحكم حسب تفضيلاتك، وإخفاء أو إظهار الأعمدة التي لا
                                تحتاج إليها.
                            </p>
                            <div class="mt-3">
                                <button class="btn btn-lg btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#reorderModal">
                                    <i class="fa fa-sliders"></i> تخصيص الأعمدة
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore x-data="reorderModal()" class="modal fade" id="reorderModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">ترتيب واظهار اعمدة لوحة النظام</h5>
                    <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div :key="itemsKey">
                        <ul x-sort x-ref="mainSortable" class="list-group">
                            <template x-for="item in items" :key="item.id + '-' + itemsKey">
                                <li x-sort:item="item.index" :data-id="item.id"
                                    class="list-group-item bg-light mb-2 rounded">

                                    <!-- Main Item -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="">
                                            <input class="form-check-input me-2" type="checkbox" x-model="item.visible"
                                                :id="'main-' + item.id + '-' + itemsKey">

                                            <label class="form-check-label fw-bold"
                                                :for="'main-' + item.id + '-' + itemsKey"
                                                :class="!item.visible ? 'text-muted text-decoration-line-through' : ''"
                                                x-text="item.label"></label>
                                        </div>
                                        <i class="fa fa-bars text-muted cursor-move" x-sort:handle></i>
                                    </div>

                                    <!-- Children -->
                                    <template x-if="item.children && item.children.length">
                                        <ul x-sort x-ref="childrenSortable" class="list-group mt-2 ms-4">
                                            <template x-for="child in item.children" :key="child.id + '-' + itemsKey">
                                                <li x-sort:item="child.index" :data-id="child.id"
                                                    class="list-group-item py-1 px-2 d-flex justify-content-between align-items-center"
                                                    :class="!item.visible || !child.visible ?
                                                        'bg-light text-muted text-decoration-line-through' : ''">
                                                    <div>
                                                        <input class="form-check-input me-2" type="checkbox"
                                                            x-model="child.visible" :disabled="!item.visible"
                                                            :id="'child-' + child.id + '-' + itemsKey">

                                                        <label class="form-check-label"
                                                            :for="'child-' + child.id + '-' + itemsKey"
                                                            :class="!child.visible ?
                                                                'text-muted text-decoration-line-through' :
                                                                ''"
                                                            x-text="child.label"></label>
                                                    </div>
                                                    <i class="fa fa-bars text-muted cursor-move" x-sort:handle></i>
                                                </li>
                                            </template>
                                        </ul>
                                    </template>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button class="btn btn-primary" @click="reset()">
                        <i class="fa fa-refresh"></i>
                    </button>
                    <div class=" d-flex items-end">
                        <button class="btn btn-secondary mx-2" data-bs-dismiss="modal">إلغاء</button>
                        <button class="btn btn-success" @click="save()">حفظ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.x.x/dist/cdn.min.js"></script>
<script>
    function reorderModal() {
        return {
            defaultItems: @json($sidebarDefaultSettings),
            items: @json($sidebarSettings),
            itemsKey: 0,
            init() {
                console.log('Modal initialized');
            },
            reset() {
                this.items = JSON.parse(JSON.stringify(this.defaultItems));
                this.itemsKey++;
            },
            save() {
                const reorderedItems = [];

                // Loop through visible DOM items (main list) and get the order
                this.$refs.mainSortable.querySelectorAll('[x-sort\\:item]').forEach((el, index) => {
                    const id = el.dataset.id;
                    const item = this.items.find(i => i.id == id);
                    if (!item) return;

                    // Handle children
                    let children = [];
                    const childEls = el.querySelectorAll('[x-ref="childrenSortable"] [x-sort\\:item]');
                    if (childEls.length && item.children) {
                        childEls.forEach((childEl, childIndex) => {
                            const childId = childEl.dataset.id;
                            const child = item.children.find(c => c.id == childId);
                            if (child) {
                                children.push({
                                    ...child,
                                    index: childIndex
                                });
                            }
                        });
                    }

                    reorderedItems.push({
                        ...item,
                        index,
                        children
                    });
                });
                var items = reorderedItems.map(item => ({
                    id: item.id,
                    index: item.index,
                    label: item.label,
                    visible: item.visible,
                    children: item.children.map(child => ({
                        id: child.id,
                        index: child.index,
                        label: child.label,
                        visible: child.visible,
                    }))
                }));



                @this.call('reorderUpdated', items);
            }
        };
    }
</script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('closeModal', () => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('reorderModal'));
            if (modal) {
                modal.hide();
            }
        });
    });
</script>
