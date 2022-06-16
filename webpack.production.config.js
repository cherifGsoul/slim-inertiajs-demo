const path = require("path");
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
  entry: "./client/js/app.js",
  mode: "development",
  module: {
    rules: [
      // Babel: React / JS
      {
        test: /\.(js|jsx)$/,
        exclude: /(node_modules|bower_components)/,
        loader: "babel-loader",
        options: { presets: ["@babel/env", '@babel/preset-react'] },
      },

      // CSS: Style Loader, CSS Loader
      {
        test:/\.css$/,
        use:[
          'style-loader',
          MiniCssExtractPlugin.loader,
          {
            loader: "css-loader", options: { importLoaders: 1 }
          },
          "postcss-loader"
    ]
    }
    ],
  },
  resolve: { extensions: ["*", ".js", ".jsx"] },
  output: {
    path: path.resolve(__dirname, "public/dist"),
    publicPath: "/dist/",
    filename: "app.js",
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename:"app.css",
  })
  ]
};