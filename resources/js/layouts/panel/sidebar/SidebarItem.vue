<template>
    <li v-if="item.type == typeMessage.TITLE" class="small">{{ item.name }}</li>
    <li v-if="item.type == typeMessage.ITEM">
        <router-link :to="{name: item.pathName}" >
            <i :class="`pi ${item.icon} font-bold`"></i>
            <span>{{ item.name }}</span>
        </router-link>
    </li>
    <li v-if="item.type == typeMessage.DROPDOWN_ITEMS" class="has-child hidden-items" >
        <a :class="isParent(item.children) ? 'parent-selected' : ''">
            <i :class="`pi ${item.icon} font-bold`"></i>
            <span>{{ item.name }}</span>
            <i class="pi pi-chevron-left font-bold"></i>
        </a>
        <ul>
            <li v-for="(i, index) in item.children" :key="index" class="flex">
                <router-link :to="{name: i.pathName}" class="pl-5">
                    <i class="pi pi-circle-fill " style="font-size: .5rem !important; "></i>
                    {{ i.name }}
                </router-link>
            </li>
        </ul>
    </li>
</template>

<script>
import { SidebarTypeMessage } from '../../../shared/constants/sidebar-type-item';
export default {
    props: {
        item: Object,
    },
    data() {
        return {
            typeMessage: SidebarTypeMessage
        }
    },
    methods: {
        isParent(children){
            return children.find(i => i.pathName == this.$store.state.sidebar.currentRoute);
        },
    }
}

</script>