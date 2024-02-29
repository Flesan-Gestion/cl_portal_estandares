<template>
    <div class="relative w-full flex-1">
        <div class="absolute top-0 bottom-0 left-0 right-0">
            <DataTable id="datatable-facturas" v-model:filters="dataTableConfig.filters" :value="standards" paginator
                showGridlines :rows="dataTableConfig.rows" :rowsPerPageOptions="dataTableConfig.rowsPerPageOptions"
                dataKey="id" filterDisplay="menu" class="p-datatable-sm overflow-auto" tableStyle="min-width: 65rem;"
                @filter="eventFilter" :globalFilterFields="dataTableConfig.globalFilterFields"
                :paginatorTemplate="dataTableConfig.paginatorTemplate"
                currentPageReportTemplate="Página {currentPage} de {totalPages}">
                <template #header>
                    <div class="flex flex-column sm:flex-row justify-content-between">
                        <Button type="button" label="Exportar a PDF" icon="pi pi-file-excel" />

                        <InputGroup class="w-auto sm:w-20rem mt-2 sm:mt-0">
                            <InputGroupAddon>
                                <i class="pi pi-search"></i>
                            </InputGroupAddon>
                            <InputText placeholder="Buscador general" v-model="dataTableConfig.filters['global'].value" />
                        </InputGroup>
                    </div>
                </template>
                <Column bodyClass="no-wrap-container max-w-5rem" headerClass="w-5rem" field="identifier" header="ID">
                </Column>
                <Column filterField="especialidad" :showFilterMatchModes="false" :filterMenuStyle="{ width: '14rem' }"
                    bodyClass="no-wrap-container max-w-12rem" headerClass="w-12rem" sortable header="ESPECIALIDAD">
                    <template #body="{ data }">
                        {{ data.especialidad }}
                    </template>
                    <template #filter="{ filterModel }">
                        <MultiSelect v-model="filterModel.value" :options="specialities" optionLabel="especialidad"
                            optionValue="especialidad" placeholder="Cualquiera" class="p-column-filter">
                        </MultiSelect>
                    </template>
                </Column>
                <Column bodyClass="no-wrap-container max-w-12rem" headerClass="w-12rem" field="inmobiliaria" sortable
                    header="INMOBILIARIA"></Column>
                <Column bodyClass="no-wrap-container max-w-12rem" headerClass="w-12rem" field="requerimiento" sortable
                    header="REQUERIMIENTO"></Column>
                <Column bodyClass="no-wrap-container max-w-12rem" headerClass="w-12rem" field="descripcion" sortable
                    header="DESCRIPCIÓN"></Column>
                <Column bodyClass="no-wrap-container max-w-5rem" headerClass="w-4rem" header="ACCIONES">
                    <template #body="{ data }">
                        <div class="flex justify-content-center gap-2 w-full">
                            <Button severity="help" icon="pi pi-comment" class="w-3rem" v-tooltip.top="'Comentar Estándar'"
                                placeholder="Top" @click="showCommentFormModal(data)" />
                            <Button severity="info" icon="pi pi-eye" class="w-3rem" v-tooltip.top="'Ver Estándar'"
                                placeholder="Top" />
                        </div>
                    </template>
                </Column>

            </DataTable>
        </div>
    </div>
    <CommentModal :visible="showCommentForm" :standardSelected="standardSelected" @closeModal="toggleCommentFormModal"
        @onSaveStandard="onSaveStandard"></CommentModal>
</template>
<script>
import { FilterMatchMode, FilterOperator } from 'primevue/api';
import { StandardService } from './services/StandardService';
import CommentModal from './components/CommentModal.vue';
export default {
    components: {
        CommentModal
    },
    data() {
        return {
            standards: [],
            filteredStandards: [],
            loadingRows: false,
            dataTableConfig: {
                rows: 20,
                rowsPerPageOptions: [10, 20, 50, 100],
                globalFilterFields: ['identifier', 'especialidad', 'inmobiliaria', 'requerimiento', 'descripcion'],
                paginatorTemplate: "RowsPerPageDropdown FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink",
                filters: {
                    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
                    especialidad: { value: null, matchMode: FilterMatchMode.IN },
                }
            },
            specialities: [],
            showCommentForm: false,
            standardSelected: null
        }
    },
    async created() {
        this.$utl.showLoader();
        this.standards = await StandardService.all();
        this.specialities = this.getSpecialities();
        this.$utl.hiddenLoader();
    },
    methods: {

        eventFilter(event) {
            this.filteredStandards = event.standards;
        },
        getSpecialities() {
            const setSpecialities = new Set(this.standards.map(s => s.especialidad));
            return [...setSpecialities].map(rsr => { return { 'especialidad': rsr } });
        },
        showCommentFormModal(standard){
            this.standardSelected = standard;
            this.toggleCommentFormModal();
        },
        toggleCommentFormModal() {
            this.showCommentForm = !this.showCommentForm;
        },
        async onSaveStandard() {
            this.showCommentForm = !this.showCommentForm;
            this.standardSelected = null
            this.standards = await StandardService.all();
            this.specialities = this.getSpecialities();
            this.$utl.hiddenLoader();
        }
    }
}
</script>