import {createVuetify} from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import colors from "vuetify/util/colors";


export default createVuetify({
    components,
    directives,

    theme: {
        themes: {
            light: {
                dark: false,
                colors: {
                    primary: colors.purple.darken1, // #E53935
                    secondary: colors.purple.lighten4, // #FFCDD2
                }
            },
            dark: {
                dark: true,
                colors: {
                    primary: colors.purple.darken1, // #E53935
                    secondary: colors.purple.lighten4, // #FFCDD2
                }
            },
        },
    }
})
