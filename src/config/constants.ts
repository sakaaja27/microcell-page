export const CONTACT_INFO = {
  WHATSAPP_NUMBER: '6285812749419',
};

export const WHATSAPP_TEMPLATES = {
  RENTAL: `Halo Admin MicroCell, saya tertarik untuk *Menyewa Unit MicroCell*. Mohon informasi lebih lanjut.`,
  PURCHASE: `Halo Admin MicroCell, saya tertarik untuk *Membeli Unit MicroCell*. Mohon informasi lebih lanjut.`,
  SERVICE: `Halo Admin MicroCell, saya ingin mendaftar *Layanan Instalasi & After-Sales Service*. Mohon informasi lebih lanjut.`,
  CONSULTATION: `Halo Admin MicroCell, saya tertarik untuk mengkonsultasikan instalasi MicroCell di peternakan saya. Mohon informasi lebih lanjut.`,
  GENERAL_INQUIRY: `Halo Admin MicroCell, saya tertarik dan ingin berkonsultasi mengenai pemasangan sistem MicroCell.`
};

export const generateWhatsAppLink = (templateKey: keyof typeof WHATSAPP_TEMPLATES) => {
  const message = encodeURIComponent(WHATSAPP_TEMPLATES[templateKey]);
  return `https://wa.me/${CONTACT_INFO.WHATSAPP_NUMBER}?text=${message}`;
};
