# GeDiCur

> Aplicación web de Gestión y Difusión de Cursos

- **Autor**: Daniel Darias Sánchez
- Realizado con motivo de las **Prácticas Externas** de la ULL en el curso 2018/2019
- Licencia: GPL

En [Manual del OSL - OC](https://github.com/tic-ull/OSL-OC/blob/master/ManualOSL-OC.pdf "Manual") se encuentra un manual para la correcta administración del **OSL-OC**.

En [plugins](https://github.com/tic-ull/OSL-OC/tree/master/plugins) se encuentran los 3 plugins que ha sido necesario modificar/crear para el desarrollo del catálogo y el código correspondiente a los 2 widget de "Últimos comentarios" y "Últimos productos actualizados", así como el plugin correspondiente para su uso. Los dos plugins principales son, el **catálogo** y el **formulario**, y un plugin **desarrollado por mí** con el objetivo de añadir funcionalidad a uno de los formularios.

* **Form Maker - ULL**: es una modificación del plugin [Form Maker](https://web-dorado.com/products/wordpress-form.html) de Web-dorado. Ha sido modificado con la intención de añadir nuevas características y mejorar las ya existentes.
* **Huge-IT Product Catalog - ULL**: es una modificación del plugin [Huge-IT Product Catalog](https://huge-it.com/product-catalog/) de Huge-IT. Ha sido modificado con la intención de añadir nuevas características y mejorar las ya existentes.
* **form-actualizacion-osl**: es un plugin creado por mí que se encarga de precargar los datos necesarios, desde la base de datos, de un producto del catálogo en el formulario de actualización cuando el usuario se disponga a realizar dicho formulario.

## Implementación de nuevas funcionalidades al catálogo

* **Autor:** Javier González Hernández

* Realizado con motivo de las prácticas externas de la ULL en el curso 2017/18.

Se han implementado las siguientes funcionalidades: 

1. **Buscador global.** Antes del desarrollo de esta nueva funcionalidad solo se permitia buscar dentro de los catálogos el software libre, ahora es posible buscar desde cualquier página. Esta nueva funcionalidad ha sido implementada en el plugin **Huge-IT Product Catalog - ULL**.

2. **Alternativas a.** Ahora es posible buscar alternativas libres al software propietario. Esta nueva funcionalidad ha sido implementada en el plugin **Huge-IT Product Catalog - ULL**.

Se han reescrito las siguientes funcionalidades:

1. **Últimos comentarios.**

2. **Últimos productos.**

Ahora ambas funcionalidades están implementadas como widgets de Wordpress. Se ha refactorizado el código y añadido opciones de personalización para los widgets.
