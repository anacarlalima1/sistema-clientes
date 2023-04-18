const mix = require("laravel-mix");

const CaseSensitivePathsWebpackPlugin = require("case-sensitive-paths-webpack-plugin");
const VuetifyLoaderPlugin = require("vuetify-loader/lib/plugin");

var pathWeb = mix.inProduction()
    ? "js/vuejs_code_split/[name].[hash].js"
    : "js/vuejs_code_split/[name].js";

var webConfig = {
    plugins: [new VuetifyLoaderPlugin(), new CaseSensitivePathsWebpackPlugin()],
    output: {
        chunkFilename: pathWeb,
    },
    resolve: {
        alias: {
            "@": path.join(__dirname, "resources/js"),
            "@resources": path.join(__dirname, "resources"),
            "@sass": path.join(__dirname, "resources/sass"),
        },
    },
};

mix.webpackConfig(webConfig);

mix.js("resources/js/app.js", "public/js").sass(
    "resources/sass/app.scss",
    "public/css"
);

if (mix.inProduction()) {
    mix.version();
}
if (!mix.inProduction()) {
    mix.browserSync({
        proxy: "http://127.0.0.1:8000",
    });
}

//teste5
