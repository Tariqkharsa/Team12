using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace GiftWebApp.Models
{
    public class GiftShop
    {
        public int Id { get; set; }
        public string ItemName { get; set; }
        public float Price { get; set; }
        public int Quantity { get; set; }

        public GiftShop()
        {

        }
    }
}
