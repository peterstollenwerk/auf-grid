import GridColumnField from "./components/fields/GridColumnField.vue";
import GridSettingsView from "./components/views/GridSettingsView.vue";

const GridIcon = `
<svg version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
 <g>
  <path d="m4.168 12.5h25v75h-25z"/>
  <path d="m70.832 12.5h25v75h-25z"/>
  <path d="m37.5 12.5h25v75h-25z"/>
 </g>
</svg>
`;

panel.plugin('auf/grid', {
  icons: {
    'grid': GridIcon
  },
  views: {
    grid: {
      component: GridSettingsView,
      icon: "grid",
      label: "Grid Settings"
    }
  },
  fields: {
    grid_column: GridColumnField
  }
});