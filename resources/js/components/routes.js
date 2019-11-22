import  MapComponent  from './MapComponent'
import MarkersView from './MarkersView';
export const routes = [
    {
        path: "/map",
        component: MapComponent
    },
    {
        path: "/allmarkers",
        component: MarkersView
    }
];
