<template>
    <div class="relative w-full flex-1">
        <div class="absolute top-0 bottom-0 left-0 right-0">

            <DataTable :value="users" :rows="dataTableConfig.rows" scrollable paginator
                v-model:filters="dataTableConfig.filters" :paginatorTemplate="dataTableConfig.paginatorTemplate"
                :rowsPerPageOptions="dataTableConfig.rowsPerPageOptions"
                :currentPageReportTemplate="dataTableConfig.currentPageReportTemplate" showGridlines
                class="p-datatable-sm overflow-auto" tableStyle="min-width:60rem">
                <template #header>
                    <div class="flex flex-column sm:flex-row justify-content-between">
                        <Button type="button" severity="success" label="Registrar" icon="pi pi-user-plus"
                            @click="toggleUserFormModal" />

                        <InputGroup class="w-auto sm:w-20rem mt-2 sm:mt-0">
                            <InputGroupAddon>
                                <i class="pi pi-search"></i>
                            </InputGroupAddon>
                            <InputText placeholder="Buscador general" v-model="dataTableConfig.filters['global'].value" />
                        </InputGroup>
                    </div>
                </template>
                <Column field="name" bodyClass="no-wrap-container max-w-9rem" sortable header="USUARIO"
                    headerClass="w-9rem">
                </Column>
                <Column field="username" bodyClass="no-wrap-container max-w-9rem" sortable header="EMAIL"
                    headerClass="w-9rem">
                </Column>
                <Column field="dni" bodyClass="no-wrap-container max-w-5rem" sortable header="DNI" headerClass="w-5rem">
                </Column>
                <Column field="pais" bodyClass="no-wrap-container max-w-7rem font-bold text-center" sortable header="PAIS"
                    headerClass="w-7rem">
                </Column>
                <Column field="estado_sesion" bodyClass="no-wrap-container max-w-7rem font-bold text-center" sortable
                    header="ESTADO" headerClass="w-7rem">
                    <template #body="{ data }">
                        <Tag :value="data.estado_sesion == 0 ? 'INACTIVO' : 'ACTIVO'"
                            :severity="data.estado_sesion == 0 ? 'danger' : 'success'" class="font-bold"
                            style="font-size: .7rem !important;">
                        </Tag>
                    </template>
                </Column>
                <Column bodyClass="no-wrap-container max-w-5rem" headerClass="w-4rem" header="ACCIONES">
                    <template #body="{ data }">
                        <div class="flex justify-content-center gap-2 w-full">
                            <Button severity="warning" icon="pi pi-pencil" class="w-3rem" v-tooltip.top="'Editar'"
                                placeholder="Top"
                                :disabled="data.id_aplicacion_usuario == this.$store.state.user.data?.id" />
                            <Button v-if="data.estado_sesion == 1" v-tooltip.top="'Inhabilitar'" placeholder="Top"
                                :disabled="data.id_aplicacion_usuario == this.$store.state.user.data?.id" severity="danger"
                                icon="pi pi-lock" class="w-3rem" @click="disableUser(data.id_aplicacion_usuario)" />
                            <Button v-if="data.estado_sesion == 0" severity="success" icon="pi pi-lock-open" class="w-3rem"
                                v-tooltip.top="'Habilitar'" placeholder="Top"
                                @click="enableUser(data.id_aplicacion_usuario)" />
                        </div>
                    </template>
                </Column>
            </DataTable>
        </div>
    </div>


    <UserForm :visible="showUserForm" :userSelected="userSelected" @closeModal="toggleUserFormModal"
        @onSaveUser="onSaveUser"></UserForm>
</template>
<script>
import { FilterMatchMode } from 'primevue/api';
import UserForm from './components/UserForm.vue';
import { UserService } from './services/UserService';
export default {
    components: {
        UserForm
    },
    data() {
        return {
            showUserForm: false,
            users: [],
            dataTableConfig: {
                rows: 10,
                rowsPerPageOptions: [10, 20, 50, 100],
                paginatorTemplate: "RowsPerPageDropdown FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink",
                currentPageReportTemplate: 'Página {currentPage} de {totalPages}',
                globalFilterFields: ['name', 'username', 'rol.nombre'],
                filters: {
                    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
                }
            },
            userSelected: null
        };
    },
    async created() {
        this.$utl.showLoader();
        this.users = await UserService.getUsers();
        this.$utl.hiddenLoader();
    },
    methods: {
        disableUser(id) {
            this.$utl.showConfirmation({
                message: 'Esta usuario se cambiará a un estado de inactivo',
                accept: async () => {
                    this.$loader.show();
                    await UserService.disable(id);
                    this.$utl.genToast(this.$tstType.USER_DISABLED);
                    this.users = await UserService.getUsers();
                    this.$loader.hidden();
                },
                reject: () => { },
            })
        },
        enableUser(id) {
            this.$utl.showConfirmation({
                message: 'Se activará el usuario seleccionado',
                accept: async () => {
                    this.$loader.show();
                    await UserService.enable(id);
                    this.$utl.genToast(this.$tstType.USER_ENABLED);
                    this.users = await UserService.getUsers();
                    this.$loader.hidden();
                },
                reject: () => { },
            })
        },
        toggleUserFormModal() {
            this.showUserForm = !this.showUserForm;
            this.userSelected = null;
        },
        async onSaveUser() {
            this.showUserForm = !this.showUserForm;
            this.userSelected = null;
            this.users = await UserService.getUsers();
            this.$utl.hiddenLoader();
        }
    }
}
</script>