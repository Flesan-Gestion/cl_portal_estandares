<template>
    <div class="relative w-full flex-1">
        <div class="absolute top-0 bottom-0 left-0 right-0">
            <DataTable id="datatable-facturas" v-model:filters="dataTableConfig.filters" :value="standards" paginator
                showGridlines :rows="dataTableConfig.rows" :rowsPerPageOptions="dataTableConfig.rowsPerPageOptions"
                dataKey="id" filterDisplay="menu" class="p-datatable-sm overflow-auto" tableStyle="min-width: 70rem;"
                @filter="eventFilter" :globalFilterFields="dataTableConfig.globalFilterFields"
                :paginatorTemplate="dataTableConfig.paginatorTemplate"
                :currentPageReportTemplate="dataTableConfig.currentPageReportTemplate">
                <template #header>
                    <div class="flex flex-column sm:flex-row justify-content-between">
                        <div class="flex gap-2" v-if="this.$utl.accessRol([this.$env.rol.ADMINISTRADOR])">
                            <Button label="Nuevo Estándar" icon="pi pi-tags" @click="showStandardFormModal()" />
                            <Button icon="pi pi-file-export" severity="success" @click="exportToExcel()"
                                label="Exportar Excel" />
                            <Button icon="pi pi-file-export" severity="help" @click="exportToPDF()"
                                label="Exportar PDF" />
                        </div>


                        <InputGroup class="w-auto sm:w-20rem mt-2 sm:mt-0">
                            <InputGroupAddon>
                                <i class="pi pi-search"></i>
                            </InputGroupAddon>
                            <InputText placeholder="Buscador general"
                                v-model="dataTableConfig.filters['global'].value" />
                        </InputGroup>
                    </div>
                </template>
                <Column bodyClass=" max-w-7rem" headerClass="w-7rem" field="st_code" header="CÓDIGO">
                </Column>
                <Column filterField="speciality" :showFilterMatchModes="false" :filterMenuStyle="{ width: '14rem' }"
                    bodyClass=" max-w-10rem" headerClass="w-10rem" sortable header="ESPECIALIDAD">

                    <template #body="{ data }">
                        {{ data.speciality.sp_description }}
                    </template>

                    <template #filter="{ filterModel }">
                        <MultiSelect v-model="filterModel.value" :options="specialities" optionLabel="sp_description"
                            placeholder="Cualquiera" class="p-column-filter" filter>
                        </MultiSelect>
                    </template>
                </Column>
                <Column filterField="real_estate" :showFilterMatchModes="false" :filterMenuStyle="{ width: '14rem' }"
                    bodyClass=" max-w-10rem" headerClass="w-10rem" sortable header="INMOBILIARIA">
                    <template #body="{ data }">
                        {{ data.real_estate.re_description }}
                    </template>

                    <template #filter="{ filterModel }">
                        <MultiSelect v-model="filterModel.value" :options="realEstates" optionLabel="re_description"
                            placeholder="Cualquiera" class="p-column-filter" filter>
                        </MultiSelect>
                    </template>
                </Column>
                <Column bodyClass=" max-w-12rem" headerClass="w-12rem" field="st_information" sortable
                    header="REQUERIMIENTOS"></Column>
                <Column bodyClass=" max-w-10rem" headerClass="w-10rem" field="st_description" sortable
                    header="DESCRIPCIÓN"></Column>
                <Column bodyClass=" max-w-12rem" headerClass="w-12rem" field="st_information" sortable
                    header="INFORMACION"></Column>
                <Column v-if="this.$utl.accessRol([this.$env.rol.ADMINISTRADOR])" bodyClass=" text-center max-w-5rem"
                    headerClass="w-5rem" field="enable" sortable header="ESTADO">
                    <template #body="{ data }">
                        <Tag :value="data.enable == 0 ? 'INACTIVO' : 'ACTIVO'"
                            :severity="data.enable == 0 ? 'danger' : 'success'" class="font-bold"
                            style="font-size: .7rem !important;">
                        </Tag>
                    </template>
                </Column>
                <Column bodyClass=" max-w-9rem" headerClass="w-9rem" header="ACCIONES">

                    <template #body="{ data }">
                        <div class="flex justify-content-center gap-2 w-full">
                            <Button severity="help" icon="pi pi-comment" class="w-3rem" v-tooltip.top="'Comentar'"
                                placeholder="Top" @click="showComments(data)" />
                            <Button v-if="this.$utl.accessRol([this.$env.rol.ADMINISTRADOR])" severity="info"
                                icon="pi pi-eye" class="w-3rem" v-tooltip.top="'Ver Detalle'" placeholder="Top"
                                @click="showStandardFormModal(data)" />


                            <Button v-if="data.enable == 1 && this.$utl.accessRol([this.$env.rol.ADMINISTRADOR])"
                                v-tooltip.top="'Desactivar'" placeholder="Top" severity="danger" icon="pi pi-lock"
                                class="w-3rem" @click="disableUser(data.st_id)" />
                            <Button v-if="data.enable == 0 && this.$utl.accessRol([this.$env.rol.ADMINISTRADOR])"
                                severity="success" icon="pi pi-lock-open" class="w-3rem" v-tooltip.top="'Activar'"
                                placeholder="Top" @click="enableUser(data.st_id)" />
                        </div>
                    </template>
                </Column>

            </DataTable>
        </div>
    </div>

    <Sidebar v-model:visible="showCommentForm" @hide="clearComments" class="w-full md:w-20rem lg:w-30rem"
        position="right">
        <template #header>
            <div class="flex align-items-center gap-2">
                <span class="text-lg font-bold">{{ standardSelected?.st_code }} | {{
                standardSelected?.real_estate?.re_description }}</span>
            </div>
        </template>
        <Comments @onSaveComment="onSaveComment" :standardSelected="standardSelected" :comments="comments"></Comments>
    </Sidebar>
    <StandardForm :visible="showStandardForm" :standardSelected="standardSelected" :specialities="specialities"
        :realEstates="realEstates" @closeModal="toggleStandardFormModal" @onSaveStandard="onSaveStandard">
    </StandardForm>
</template>

<script>
import { FilterMatchMode } from 'primevue/api';
import { StandardService } from './services/StandardService';
import { SpecialityService } from './services/SpecialityService';
import { CommentService } from './services/CommentService';
import { RealEstateService } from './services/RealEstateService';
import StandardForm from './components/StandardForm.vue';
import Comments from './components/Comments.vue';
import XLSX from "xlsx/dist/xlsx.full.min";
import jsPDF from 'jspdf';
import autoTable from 'jspdf-autotable'

export default {
    components: {
        Comments,
        StandardForm
    },
    data() {
        return {
            standards: [],
            filteredStandards: [],
            loadingRows: false,
            dataTableConfig: {
                rows: 20,
                rowsPerPageOptions: [10, 20, 50, 100],
                globalFilterFields: ['st_code', 'speciality.sp_description', 'real_estate.re_description', 'st_request', 'st_type_definition', 'st_information'],
                paginatorTemplate: "RowsPerPageDropdown FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink",
                currentPageReportTemplate: "Página {currentPage} de {totalPages}",
                filters: {
                    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
                    speciality: { value: null, matchMode: FilterMatchMode.IN },
                    real_estate: { value: null, matchMode: FilterMatchMode.IN },
                }
            },
            specialities: [],
            realEstates: [],
            showCommentForm: false,
            showStandardForm: false,
            standardSelected: null,
            comments: []
        }
    },
    async created() {
        this.$utl.showLoader();
        await this.getStandards();
        this.specialities = await SpecialityService.all();
        this.realEstates = await RealEstateService.all();
        this.$utl.hiddenLoader();
    },
    methods: {
        async getStandards() {
            switch (this.$store.state.user.data.rol.id_rol) {
                case this.$env.rol.ADMINISTRADOR:
                    this.standards = await StandardService.allAdministrator();
                    break;
                case this.$env.rol.VISUALIZADOR:
                    this.standards = await StandardService.allViewer();
                    break;
            }
            this.filteredStandards = [...this.standards];
        },
        async showComments(standard) {
            this.$utl.showLoader();
            this.standardSelected = standard;
            this.showCommentForm = true;
            this.comments = await CommentService.getByStandard(standard.st_id);
            this.$utl.hiddenLoader();
        },
        eventFilter(event) {
            this.filteredStandards = event.filteredValue;
        },
        clearComments() {
            this.comments = [];
        },
        showStandardFormModal(standard = null) {
            this.standardSelected = standard;
            this.toggleStandardFormModal();
        },
        toggleStandardFormModal() {
            this.showStandardForm = !this.showStandardForm;
        },
        disableUser(id) {
            this.$utl.showConfirmation({
                message: 'Se deshabilitará el estándar inmobiliario seleccionado',
                accept: async () => {
                    this.$utl.showLoader();
                    await StandardService.disable(id);
                    this.$utl.genToast(this.$tstType.STANDARD_DISABLED);
                    await this.getStandards();
                    this.$utl.hiddenLoader();
                },
                reject: () => { },
            })
        },
        enableUser(id) {
            this.$utl.showConfirmation({
                message: 'Se habilitará el estándar inmobiliario seleccionado',
                accept: async () => {
                    this.$utl.showLoader();
                    await StandardService.enable(id);
                    this.$utl.genToast(this.$tstType.STANDARD_ENABLED);
                    await this.getStandards();
                    this.$utl.hiddenLoader();
                },
                reject: () => { },
            })
        },
        exportToExcel() {
            const standardsToExcel = this.filteredStandards.map(s => {
                return {
                    'Código': s.st_code,
                    'Especialidad': s.speciality.sp_description,
                    'Inmobiliaria': s.real_estate.re_description,
                    'Requerimientos': s.st_request,
                    'Descripción': s.st_description,
                    'Información': s.st_information,
                    'Estado': s.enable == 1 ? 'Activo' : 'Inactivo',
                    'Creación': `${this.$utl.formatDate(new Date(s.created_at))} ${this.$utl.formatTime(new Date(s.created_at))}`,
                    'Última Actualización': `${this.$utl.formatDate(new Date(s.updated_at))} ${this.$utl.formatTime(new Date(s.updated_at))}`,
                }
            })

            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.json_to_sheet(standardsToExcel);

            XLSX.utils.book_append_sheet(wb, ws, 'Estándares');

            XLSX.writeFile(wb, `ESTÁNDARES INMOBILIARIOS.xlsx`);
        },
        exportToPDF() {
            const columns = ['Código', 'Especialidad', 'Inmobiliaria', 'Requerimientos', 'Descripción', 'Información', 'Estado']
            const rows = this.filteredStandards.map(s => {
                return [
                    { content: s.st_code, styles: { minCellWidth: 18 } },
                    s.speciality.sp_description,
                    { content: s.real_estate.re_description, styles: { minCellWidth: 20 } },
                    s.st_request,
                    { content: s.st_description, styles: { minCellWidth: 40 } },
                    { content: s.st_information, styles: { minCellWidth: 40 } },
                    { content: s.enable == 1 ? 'Activo' : 'Inactivo', styles: { minCellWidth: 16 } },

                ]
            })
            const doc = new jsPDF();
            autoTable(doc, {
                head: [columns],
                body: [
                    ...rows
                ],
                theme: 'grid',
                headStyles: {
                    fillColor: [255, 0, 14]
                }
            });
            doc.save('ESTÁNDARES INMOBILIARIOS.pdf');
        },
        async onSaveStandard() {
            this.showCommentForm = false;
            this.showStandardForm = false;
            this.standardSelected = null;
            await this.getStandards();
            this.$utl.hiddenLoader();
        },
        async onSaveComment() {
            this.comments = await CommentService.getByStandard(this.standardSelected.st_id);
            this.$utl.hiddenLoader();
        }
    }
}
</script>