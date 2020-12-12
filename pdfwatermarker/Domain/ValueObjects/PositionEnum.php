<?php



class PositionEnum  {
     const CENTER = 'center';
     const TOPLEFT ='topleft';
     const TOPRIGHT = 'topright';
     const BOTTOMRIGHT ='bottomright';
     const BOTTOMLEFT  ='bottomleft';
   
    
	public static function CENTER()
	{
		return self::CENTER;
    }
    public static function TOPLEFT()
	{
		return self::TOPLEFT;
    }
    public static function TOPRIGHT()
	{
		return self::TOPRIGHT;
    }
    public static function BOTTOMRIGHT()
	{
		return self::BOTTOMRIGHT;
	}
  public static function BOTTOMLEFT()
	{
		return self::BOTTOMLEFT;
	}
}
?>
