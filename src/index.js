import GridColumnPresetField from "./components/fields/GridColumnPresetField.vue";
import InlineGridItemsSpanClassesField from "./components/fields/InlineGridItemsSpanClassesField.vue";
import GridAlignItemsField from "./components/fields/GridAlignItemsField.vue";
import GridJustifyItemsField from "./components/fields/GridJustifyItemsField.vue";
import GridSettingsView from "./components/views/GridSettingsView.vue";

const GridIcon = `<svg version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><g><path d="m4.168 12.5h25v75h-25z"/><path d="m70.832 12.5h25v75h-25z"/><path d="m37.5 12.5h25v75h-25z"/></g></svg>`;


panel.plugin('auf/grid', {
  icons: {
    'grid': GridIcon
  },
  views: {
    grid: {
      component: GridSettingsView,
      icon: "grid",
      label: "Grid"
    }
  },
  fields: {
    grid_column_preset: GridColumnPresetField,
    inline_grid_items_span_classes: InlineGridItemsSpanClassesField,
    grid_align_items: GridAlignItemsField,
    grid_justify_items: GridJustifyItemsField
  }
});