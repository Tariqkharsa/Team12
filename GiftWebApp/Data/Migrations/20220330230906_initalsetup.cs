using Microsoft.EntityFrameworkCore.Migrations;

namespace GiftWebApp.Data.Migrations
{
    public partial class initalsetup : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "GiftShop",
                columns: table => new
                {
                    Id = table.Column<int>(nullable: false),
                    ItemName = table.Column<string>(nullable: true),
                    Price = table.Column<float>(nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_GiftShop", x => x.Id);
                });
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "GiftShop");
        }
    }
}
