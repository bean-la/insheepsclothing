const path = require('path');
const webpack = require('webpack');

const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const TerserPlugin = require("terser-webpack-plugin");

module.exports = {
  entry: './src/js/main.js',
  output: {
    path: path.resolve(__dirname, 'dist/js'),
    filename: 'main.js'
  },
  externals: {
    "jquery": "jQuery" // We declare jQuery as an externa dependency because we add it thru worpdress enqueue
  },
  resolve: {
    extensions: ['.js', '.css', '.styl', '.svg']
  },

  module: {
    rules: [
      { 
        test: /\.styl$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader, 
            options: { 
              publicPath: '/dist'
            }
          },
          {
            loader: 'css-loader', 
            options: { 
              sourceMap: true, 
              url: false 
            }
          },
          {
            loader: 'stylus-native-loader'
          }
        ]
      },
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: 'babel-loader?cacheDirectory'
      },
      {
        test: /\.(eot|woff|woff2|svg|ttf)([\?]?.*)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: 'static/fonts/[name].[ext]'
            }
          }
        ]
      }
    ]
  },

  optimization: {
    minimizer: [
      new TerserPlugin(),
      new CssMinimizerPlugin(),
    ],
  },

  plugins: [
    new MiniCssExtractPlugin({
      filename: "../css/site.css"
    })
  ],

  stats: {
    colors: true
  },

  devtool: 'source-map',
  watch: true,
};
