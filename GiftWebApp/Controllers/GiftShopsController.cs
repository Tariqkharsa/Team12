using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using GiftWebApp.Data;
using GiftWebApp.Models;
using Microsoft.AspNetCore.Authorization;

namespace GiftWebApp.Controllers
{
    public class GiftShopsController : Controller
    {
        private readonly ApplicationDbContext _context;

        public GiftShopsController(ApplicationDbContext context)
        {
            _context = context;
        }

        // GET: GiftShops
        public async Task<IActionResult> Index()
        {
            return View(await _context.GiftShop.ToListAsync());
        }
        public async Task<IActionResult> ShowSearchForm()
        {
            return View();
        }

        //PoST: GiftShops/ShowSearchResults
        public async Task<IActionResult> ShowSearchResults(String SearchPhrase)
        {
            return View("Index", await _context.GiftShop.Where( j => j.ItemName.Contains(SearchPhrase)).ToListAsync());
        }
        // GET: GiftShops/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var giftShop = await _context.GiftShop
                .FirstOrDefaultAsync(m => m.Id == id);
            if (giftShop == null)
            {
                return NotFound();
            }

            return View(giftShop);
        }

        // GET: GiftShops/Create
        public IActionResult Create()
        {
            return View();
        }

        // POST: GiftShops/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to, for 
        // more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        [Authorize]
        public async Task<IActionResult> Create([Bind("Id,ItemName,Price,Quantity")] GiftShop giftShop)
        {
            if (ModelState.IsValid)
            {
                _context.Add(giftShop);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            return View(giftShop);
        }

        // GET: GiftShops/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var giftShop = await _context.GiftShop.FindAsync(id);
            if (giftShop == null)
            {
                return NotFound();
            }
            return View(giftShop);
        }

        // POST: GiftShops/Edit/5
        // To protect from overposting attacks, enable the specific properties you want to bind to, for 
        // more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("Id,ItemName,Price")] GiftShop giftShop)
        {
            if (id != giftShop.Id)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(giftShop);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!GiftShopExists(giftShop.Id))
                    {
                        return NotFound();
                    }
                    else
                    {
                        throw;
                    }
                }
                return RedirectToAction(nameof(Index));
            }
            return View(giftShop);
        }

        // GET: GiftShops/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var giftShop = await _context.GiftShop
                .FirstOrDefaultAsync(m => m.Id == id);
            if (giftShop == null)
            {
                return NotFound();
            }

            return View(giftShop);
        }

        // POST: GiftShops/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var giftShop = await _context.GiftShop.FindAsync(id);
            _context.GiftShop.Remove(giftShop);
            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool GiftShopExists(int id)
        {
            return _context.GiftShop.Any(e => e.Id == id);
        }
    }
}
