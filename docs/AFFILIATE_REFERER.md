## 📄 Documento de Requerimientos – `AffiliateReferer`

### 📌 Descripción general

El módulo `AffiliateReferer` permite que un afiliado invite a otro afiliado a participar en un programa de afiliados al cual ya pertenece. Este sistema permite generar una red simple de referidos donde los afiliados que invitan obtienen una pequeña parte de las ganancias generadas por los afiliados que han invitado, en caso de que estos realicen ventas exitosas.

---

### ⚖️ Reglas de funcionamiento para evitar abuso

1. **No existen incentivos por invitación directa.**
2. **El sistema se restringe a un solo nivel de ganancias.**

   * Un afiliado puede ganar comisiones **solo por los afiliados que él mismo invitó**.
   * No se genera comisión alguna por afiliados de segundo o tercer nivel.
3. **La comisión del afiliado padre (manager)** se **deduce de la comisión del afiliado hijo**.
4. **La comisión del afiliado manager es configurable por el dueño del programa**, pero debe incluirse una nota recomendando un valor entre **5% y 15%**, como rango justo y motivador.
5. **Ejemplo práctico de comisión:**

   * Un producto cuesta **100 USD**.
   * El afiliado **B** lo vende y normalmente ganaría **40 USD**.
   * Como **B fue invitado por A**, y el programa tiene configurado un 10% de comisión para el afiliado manager:

     * El sistema transfiere **4 USD** a **A** (`affiliate_manager_fee`).
     * B recibe **36 USD** de comisión neta.
   * Todo debe quedar registrado con trazabilidad y detalle contable en los logs de conversión.

---

### 🔐 Control de contracargos y comisiones retenidas

Para evitar fraudes y contracargos que puedan afectar el balance del sistema, se deben implementar los siguientes mecanismos:

1. **El programa debe habilitar una configuración para permitir o no la invitación de afiliados por otros afiliados.**

   * Esta configuración puede incluir una opción de **revisión manual** del nuevo afiliado invitado antes de que pueda comenzar a referir.

2. **Congelamiento de comisiones por contracargos:**

   * Debe existir una **API interna de SeguroPro** que permita a plataformas externas (como ProfeMX) congelar, marcar como pendiente, fraudulenta o retenida cualquier comisión específica.
   * Esta API debe recibir como mínimo: `external_order_id`, `affiliate_id`, `status`, `reason`.

3. **Configuración de periodo de retención (cooldown):**

   * Cada programa puede definir una **fecha o periodo (por ejemplo, 90 días)** posterior a la conversión para que la comisión se considere **liberable**.
   * Alternativamente, la liberación también puede realizarse mediante una **notificación desde backend externo** (como ProfeMX) que indique que la orden ha sido verificada y no tiene riesgo, enviando `external_order_id`.

---

### 🚨 Detección de actividad sospechosa

Se deben implementar reglas automáticas para marcar afiliados o conversiones como sospechosas:

* 🛑 **IP compartida entre afiliado y comprador.**

  * Si una conversión tiene la misma IP registrada entre el afiliado que refirió y el comprador, se debe marcar como `suspicious_ip_match`.
  * Estas comisiones deben **quedar en estado pendiente** hasta revisión manual o automática.

* 📈 **Volumen inusualmente alto de ventas en poco tiempo.**

  * Si un afiliado genera más de X conversiones por día, o tiene un spike de ventas no proporcional a su historial, se le puede marcar como `fraud_risk = true`.
  * Todas sus comisiones pasarán automáticamente a estado `pending_high_risk`.

---

### 📡 Webhooks e integraciones externas

* Se deben **añadir webhooks en `omni.billings`** para escuchar notificaciones de contracargos provenientes de las pasarelas de pago (Stripe, PayPal, etc.).
* Estos webhooks deben ser canalizados hacia SeguroPro para congelar o revertir comisiones vinculadas a esos pagos.
* Toda conversión debe poder trazarse por:

  * `external_order_id`
  * `affiliate_click_id` (opcional)
  * `affiliate_id`

---

### ✅ Estados de comisión esperados

Cada comisión debe pasar por los siguientes estados de ciclo de vida:

1. `pending` – recién registrada, en espera de validación o cooldown.
2. `ready_to_withdraw` – segura para retiro (pasó cooldown y no tiene disputas).
3. `on_hold` – congelada por sospecha o contracargo.
4. `reversed` – cancelada por contracargo confirmado o fraude.
5. `paid` – retirada por el afiliado.

---

¿Deseas que también estructure la base de datos y los modelos Laravel para este módulo?
