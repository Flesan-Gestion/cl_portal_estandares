
import { SidebarTypeMessage } from "./sidebar-type-item";
import { environment } from "../../environment/environment";


export const SidebarItems = [
    {
        name: 'Estándares',
        pathName: 'Standards',
        icon: 'pi-tags',
        type: SidebarTypeMessage.ITEM
    },
    {
        name: 'Usuarios',
        pathName: 'Users',
        icon: 'pi-user',
        type: SidebarTypeMessage.ITEM,
        roles: [environment.rol.ADMINISTRADOR]
    },
]