<?php namespace library;
use FFI;
use library\double;
interface iZint {}
interface iZint_ptr {}
class Zint {
    const SOFILE = '/usr/local/lib/libzint.so';
    const TYPES_DEF = 'struct zint_vector_rect {
  float x;
  float y;
  float height;
  float width;
  int colour;
  struct zint_vector_rect *next;
};
struct zint_vector_hexagon {
  float x;
  float y;
  float diameter;
  int rotation;
  struct zint_vector_hexagon *next;
};
struct zint_vector_string {
  float x;
  float y;
  float fsize;
  float width;
  int length;
  int rotation;
  int halign;
  unsigned char *text;
  struct zint_vector_string *next;
};
struct zint_vector_circle {
  float x;
  float y;
  float diameter;
  float width;
  int colour;
  struct zint_vector_circle *next;
};
struct zint_vector {
  float width;
  float height;
  struct zint_vector_rect *rectangles;
  struct zint_vector_hexagon *hexagons;
  struct zint_vector_string *strings;
  struct zint_vector_circle *circles;
};
struct zint_structapp {
  int index;
  int count;
  char id[32];
};
struct zint_symbol {
  int symbology;
  float height;
  float scale;
  int whitespace_width;
  int whitespace_height;
  int border_width;
  int output_options;
  char fgcolour[16];
  char bgcolour[16];
  char *fgcolor;
  char *bgcolor;
  char outfile[256];
  char primary[128];
  int option_1;
  int option_2;
  int option_3;
  int show_hrt;
  int fontsize;
  int input_mode;
  int eci;
  float dpmm;
  float dot_size;
  float text_gap;
  float guard_descent;
  struct zint_structapp structapp;
  int warn_level;
  int debug;
  unsigned char text[128];
  int rows;
  int width;
  unsigned char encoded_data[200][144];
  float row_height[200];
  char errtxt[100];
  unsigned char *bitmap;
  int bitmap_width;
  int bitmap_height;
  unsigned char *alphamap;
  unsigned int bitmap_byte_length;
  struct zint_vector *vector;
};
struct zint_seg {
  unsigned char *source;
  int length;
  int eci;
};
';
    const HEADER_DEF = self::TYPES_DEF . 'extern struct zint_symbol *ZBarcode_Create(void);
extern void ZBarcode_Clear(struct zint_symbol *symbol);
extern void ZBarcode_Delete(struct zint_symbol *symbol);
extern int ZBarcode_Encode(struct zint_symbol *symbol, unsigned char *source, int length);
extern int ZBarcode_Encode_Segs(struct zint_symbol *symbol, struct zint_seg segs[], int seg_count);
extern int ZBarcode_Encode_File(struct zint_symbol *symbol, char *filename);
extern int ZBarcode_Print(struct zint_symbol *symbol, int rotate_angle);
extern int ZBarcode_Encode_and_Print(struct zint_symbol *symbol, unsigned char *source, int length, int rotate_angle);
extern int ZBarcode_Encode_Segs_and_Print(struct zint_symbol *symbol, struct zint_seg segs[], int seg_count, int rotate_angle);
extern int ZBarcode_Encode_File_and_Print(struct zint_symbol *symbol, char *filename, int rotate_angle);
extern int ZBarcode_Buffer(struct zint_symbol *symbol, int rotate_angle);
extern int ZBarcode_Encode_and_Buffer(struct zint_symbol *symbol, unsigned char *source, int length, int rotate_angle);
extern int ZBarcode_Encode_Segs_and_Buffer(struct zint_symbol *symbol, struct zint_seg segs[], int seg_count, int rotate_angle);
extern int ZBarcode_Encode_File_and_Buffer(struct zint_symbol *symbol, char *filename, int rotate_angle);
extern int ZBarcode_Buffer_Vector(struct zint_symbol *symbol, int rotate_angle);
extern int ZBarcode_Encode_and_Buffer_Vector(struct zint_symbol *symbol, unsigned char *source, int length, int rotate_angle);
extern int ZBarcode_Encode_Segs_and_Buffer_Vector(struct zint_symbol *symbol, struct zint_seg segs[], int seg_count, int rotate_angle);
extern int ZBarcode_Encode_File_and_Buffer_Vector(struct zint_symbol *symbol, char *filename, int rotate_angle);
extern int ZBarcode_ValidID(int symbol_id);
extern int ZBarcode_BarcodeName(int symbol_id, char name[32]);
extern unsigned int ZBarcode_Cap(int symbol_id, unsigned int cap_flag);
extern float ZBarcode_Default_Xdim(int symbol_id);
extern float ZBarcode_Scale_From_XdimDp(int symbol_id, float x_dim_mm, float dpmm, char *filetype);
extern float ZBarcode_XdimDp_From_Scale(int symbol_id, float scale, float x_dim_mm_or_dpmm, char *filetype);
extern int ZBarcode_NoPng(void);
extern int ZBarcode_Version(void);
';
    private FFI $ffi;
    private static FFI $staticFFI;
    private array $__literalStrings = [];
    const __x86_64__ = 1;
    const __LP64__ = 1;
    const __GNUC_VA_LIST = 1;
    const __GNUC__ = 4;
    const __GNUC_MINOR__ = 2;
    const __STDC__ = 1;
    const BARCODE_CODE11 = 1;
    const BARCODE_C25STANDARD = 2;
    const BARCODE_C25MATRIX = 2;
    const BARCODE_C25INTER = 3;
    const BARCODE_C25IATA = 4;
    const BARCODE_C25LOGIC = 6;
    const BARCODE_C25IND = 7;
    const BARCODE_CODE39 = 8;
    const BARCODE_EXCODE39 = 9;
    const BARCODE_EANX = 13;
    const BARCODE_EANX_CHK = 14;
    const BARCODE_GS1_128 = 16;
    const BARCODE_EAN128 = 16;
    const BARCODE_CODABAR = 18;
    const BARCODE_CODE128 = 20;
    const BARCODE_DPLEIT = 21;
    const BARCODE_DPIDENT = 22;
    const BARCODE_CODE16K = 23;
    const BARCODE_CODE49 = 24;
    const BARCODE_CODE93 = 25;
    const BARCODE_FLAT = 28;
    const BARCODE_DBAR_OMN = 29;
    const BARCODE_RSS14 = 29;
    const BARCODE_DBAR_LTD = 30;
    const BARCODE_RSS_LTD = 30;
    const BARCODE_DBAR_EXP = 31;
    const BARCODE_RSS_EXP = 31;
    const BARCODE_TELEPEN = 32;
    const BARCODE_UPCA = 34;
    const BARCODE_UPCA_CHK = 35;
    const BARCODE_UPCE = 37;
    const BARCODE_UPCE_CHK = 38;
    const BARCODE_POSTNET = 40;
    const BARCODE_MSI_PLESSEY = 47;
    const BARCODE_FIM = 49;
    const BARCODE_LOGMARS = 50;
    const BARCODE_PHARMA = 51;
    const BARCODE_PZN = 52;
    const BARCODE_PHARMA_TWO = 53;
    const BARCODE_CEPNET = 54;
    const BARCODE_PDF417 = 55;
    const BARCODE_PDF417COMP = 56;
    const BARCODE_PDF417TRUNC = 56;
    const BARCODE_MAXICODE = 57;
    const BARCODE_QRCODE = 58;
    const BARCODE_CODE128AB = 60;
    const BARCODE_CODE128B = 60;
    const BARCODE_AUSPOST = 63;
    const BARCODE_AUSREPLY = 66;
    const BARCODE_AUSROUTE = 67;
    const BARCODE_AUSREDIRECT = 68;
    const BARCODE_ISBNX = 69;
    const BARCODE_RM4SCC = 70;
    const BARCODE_DATAMATRIX = 71;
    const BARCODE_EAN14 = 72;
    const BARCODE_VIN = 73;
    const BARCODE_CODABLOCKF = 74;
    const BARCODE_NVE18 = 75;
    const BARCODE_JAPANPOST = 76;
    const BARCODE_KOREAPOST = 77;
    const BARCODE_DBAR_STK = 79;
    const BARCODE_RSS14STACK = 79;
    const BARCODE_DBAR_OMNSTK = 80;
    const BARCODE_RSS14STACK_OMNI = 80;
    const BARCODE_DBAR_EXPSTK = 81;
    const BARCODE_RSS_EXPSTACK = 81;
    const BARCODE_PLANET = 82;
    const BARCODE_MICROPDF417 = 84;
    const BARCODE_USPS_IMAIL = 85;
    const BARCODE_ONECODE = 85;
    const BARCODE_PLESSEY = 86;
    const BARCODE_TELEPEN_NUM = 87;
    const BARCODE_ITF14 = 89;
    const BARCODE_KIX = 90;
    const BARCODE_AZTEC = 92;
    const BARCODE_DAFT = 93;
    const BARCODE_DPD = 96;
    const BARCODE_MICROQR = 97;
    const BARCODE_HIBC_128 = 98;
    const BARCODE_HIBC_39 = 99;
    const BARCODE_HIBC_DM = 102;
    const BARCODE_HIBC_QR = 104;
    const BARCODE_HIBC_PDF = 106;
    const BARCODE_HIBC_MICPDF = 108;
    const BARCODE_HIBC_BLOCKF = 110;
    const BARCODE_HIBC_AZTEC = 112;
    const BARCODE_DOTCODE = 115;
    const BARCODE_HANXIN = 116;
    const BARCODE_MAILMARK_2D = 119;
    const BARCODE_UPU_S10 = 120;
    const BARCODE_MAILMARK_4S = 121;
    const BARCODE_MAILMARK = 121;
    const BARCODE_AZRUNE = 128;
    const BARCODE_CODE32 = 129;
    const BARCODE_EANX_CC = 130;
    const BARCODE_GS1_128_CC = 131;
    const BARCODE_EAN128_CC = 131;
    const BARCODE_DBAR_OMN_CC = 132;
    const BARCODE_RSS14_CC = 132;
    const BARCODE_DBAR_LTD_CC = 133;
    const BARCODE_RSS_LTD_CC = 133;
    const BARCODE_DBAR_EXP_CC = 134;
    const BARCODE_RSS_EXP_CC = 134;
    const BARCODE_UPCA_CC = 135;
    const BARCODE_UPCE_CC = 136;
    const BARCODE_DBAR_STK_CC = 137;
    const BARCODE_RSS14STACK_CC = 137;
    const BARCODE_DBAR_OMNSTK_CC = 138;
    const BARCODE_RSS14_OMNI_CC = 138;
    const BARCODE_DBAR_EXPSTK_CC = 139;
    const BARCODE_RSS_EXPSTACK_CC = 139;
    const BARCODE_CHANNEL = 140;
    const BARCODE_CODEONE = 141;
    const BARCODE_GRIDMATRIX = 142;
    const BARCODE_UPNQR = 143;
    const BARCODE_ULTRA = 144;
    const BARCODE_RMQR = 145;
    const BARCODE_BC412 = 146;
    const BARCODE_LAST = 146;
    const BARCODE_BIND_TOP = 0x0001;
    const BARCODE_BIND = 0x0002;
    const BARCODE_BOX = 0x0004;
    const BARCODE_STDOUT = 0x0008;
    const READER_INIT = 0x0010;
    const SMALL_TEXT = 0x0020;
    const BOLD_TEXT = 0x0040;
    const CMYK_COLOUR = 0x0080;
    const BARCODE_DOTTY_MODE = 0x0100;
    const GS1_GS_SEPARATOR = 0x0200;
    const OUT_BUFFER_INTERMEDIATE = 0x0400;
    const BARCODE_QUIET_ZONES = 0x0800;
    const BARCODE_NO_QUIET_ZONES = 0x1000;
    const COMPLIANT_HEIGHT = 0x2000;
    const DATA_MODE = 0;
    const UNICODE_MODE = 1;
    const GS1_MODE = 2;
    const ESCAPE_MODE = 0x0008;
    const GS1PARENS_MODE = 0x0010;
    const GS1NOCHECK_MODE = 0x0020;
    const HEIGHTPERROW_MODE = 0x0040;
    const FAST_MODE = 0x0080;
    const EXTRA_ESCAPE_MODE = 0x0100;
    const DM_SQUARE = 100;
    const DM_DMRE = 101;
    const ZINT_FULL_MULTIBYTE = 200;
    const ULTRA_COMPRESSION = 128;
    const ZINT_WARN_INVALID_OPTION = 2;
    const ZINT_WARN_USES_ECI = 3;
    const ZINT_WARN_NONCOMPLIANT = 4;
    const ZINT_ERROR = 5;
    const ZINT_ERROR_TOO_LONG = 5;
    const ZINT_ERROR_INVALID_DATA = 6;
    const ZINT_ERROR_INVALID_CHECK = 7;
    const ZINT_ERROR_INVALID_OPTION = 8;
    const ZINT_ERROR_ENCODING_PROBLEM = 9;
    const ZINT_ERROR_FILE_ACCESS = 10;
    const ZINT_ERROR_MEMORY = 11;
    const ZINT_ERROR_FILE_WRITE = 12;
    const ZINT_ERROR_USES_ECI = 13;
    const ZINT_ERROR_NONCOMPLIANT = 14;
    const WARN_DEFAULT = 0;
    const WARN_FAIL_ALL = 2;
    const ZINT_CAP_HRT = 0x0001;
    const ZINT_CAP_STACKABLE = 0x0002;
    const ZINT_CAP_EXTENDABLE = 0x0004;
    const ZINT_CAP_COMPOSITE = 0x0008;
    const ZINT_CAP_ECI = 0x0010;
    const ZINT_CAP_GS1 = 0x0020;
    const ZINT_CAP_DOTTY = 0x0040;
    const ZINT_CAP_QUIET_ZONES = 0x0080;
    const ZINT_CAP_FIXED_RATIO = 0x0100;
    const ZINT_CAP_READER_INIT = 0x0200;
    const ZINT_CAP_FULL_MULTIBYTE = 0x0400;
    const ZINT_CAP_MASK = 0x0800;
    const ZINT_CAP_STRUCTAPP = 0x1000;
    const ZINT_CAP_COMPLIANT_HEIGHT = 0x2000;
    const ZINT_MAX_DATA_LEN = 17400;
    const ZINT_MAX_SEG_COUNT = 256;
    const ZINT_DEBUG_PRINT = 0x0001;
    const ZINT_DEBUG_TEST = 0x0002;
    public function __construct(?string $pathToSoFile = self::SOFILE) {
        $this->ffi = FFI::cdef(self::HEADER_DEF, $pathToSoFile);
    }

    public static function cast(iZint $from, string $to): iZint {
        if (!is_a($to, iZint::class)) {
            throw new \LogicException("Cannot cast to a non-wrapper type");
        }
        return new $to(self::$staticFFI->cast($to::getType(), $from->getData()));
    }

    public static function makeArray(string $class, int|array $elements): iZint {
        $type = $class::getType();
        if (substr($type, -1) !== "*") {
            throw new \LogicException("Attempting to make a non-pointer element into an array");
        }
        if (is_int($elements)) {
            $cdata = self::$staticFFI->new(substr($type, 0, -1) . "[$elements]");
        } else {
            $cdata = self::$staticFFI->new(substr($type, 0, -1) . "[" . count($elements) . "]");
            foreach ($elements as $key => $raw) {
                $cdata[$key] = \is_scalar($raw) ? \is_int($raw) && $type === "char*" ? \chr($raw) : $raw : $raw->getData();
            }
        }
        return new $class($cdata);
    }

    public static function sizeof($classOrObject): int {
        if (is_object($classOrObject) && $classOrObject instanceof iZint) {
            return self::$staticFFI->sizeof($classOrObject->getData());
        } elseif (is_a($classOrObject, iZint::class)) {
            return self::$staticFFI->sizeof(self::$staticFFI->type($classOrObject::getType()));
        } else {
            throw new \LogicException("Unknown class/object passed to sizeof()");
        }
    }

    public function getFFI(): FFI {
        return $this->ffi;
    }


    public function __get(string $name) {
        switch($name) {
            default: return $this->ffi->$name;
        }
    }
    public function __set(string $name, $value) {
        switch($name) {
            default: return $this->ffi->$name;
        }
    }
    public function __allocCachedString(string $str): FFI\CData {
        return $this->__literalStrings[$str] ??= string_::ownedZero($str)->getData();
    }
    public function ZBarcode_Create(): ?struct_zint_symbol_ptr {
        $result = $this->ffi->ZBarcode_Create();
        return $result === null ? null : new struct_zint_symbol_ptr($result);
    }
    public function ZBarcode_Clear(void_ptr | struct_zint_symbol_ptr | null | array $symbol): void {
        $__ffi_internal_refssymbol = [];
        if (\is_array($symbol)) {
            $_ = $this->ffi->new("struct zint_symbol[" . \count($symbol) . "]");
            $_i = 0;
            foreach ($symbol as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($symbol, $_k)) {
                    $__ffi_internal_refssymbol[$_i] = &$symbol[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsymbol = $symbol = $_;
        } else {
            $symbol = $symbol?->getData();
        }
        $this->ffi->ZBarcode_Clear($symbol);
        foreach ($__ffi_internal_refssymbol as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsymbol[$_k];
        }
    }
    public function ZBarcode_Delete(void_ptr | struct_zint_symbol_ptr | null | array $symbol): void {
        $__ffi_internal_refssymbol = [];
        if (\is_array($symbol)) {
            $_ = $this->ffi->new("struct zint_symbol[" . \count($symbol) . "]");
            $_i = 0;
            foreach ($symbol as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($symbol, $_k)) {
                    $__ffi_internal_refssymbol[$_i] = &$symbol[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsymbol = $symbol = $_;
        } else {
            $symbol = $symbol?->getData();
        }
        $this->ffi->ZBarcode_Delete($symbol);
        foreach ($__ffi_internal_refssymbol as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsymbol[$_k];
        }
    }
    public function ZBarcode_Encode(void_ptr | struct_zint_symbol_ptr | null | array $symbol, void_ptr | unsigned_char_ptr | null | string | array $source, int $length): int {
        $__ffi_internal_refssymbol = [];
        if (\is_array($symbol)) {
            $_ = $this->ffi->new("struct zint_symbol[" . \count($symbol) . "]");
            $_i = 0;
            foreach ($symbol as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($symbol, $_k)) {
                    $__ffi_internal_refssymbol[$_i] = &$symbol[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsymbol = $symbol = $_;
        } else {
            $symbol = $symbol?->getData();
        }
        $__ffi_internal_refssource = [];
        if (\is_string($source)) {
            $source = string_::ownedZero($source)->getData();
        } elseif (\is_array($source)) {
            $_ = $this->ffi->new("unsigned char[" . \count($source) . "]");
            $_i = 0;
            foreach ($source as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($source, $_k)) {
                    $__ffi_internal_refssource[$_i] = &$source[$_k];
                }
                $_[$_i++] = $_v ?? 0;
            }
            $__ffi_internal_originalsource = $source = $_;
        } else {
            $source = $source?->getData();
        }
        $result = $this->ffi->ZBarcode_Encode($symbol, $source, $length);
        foreach ($__ffi_internal_refssymbol as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsymbol[$_k];
        }
        foreach ($__ffi_internal_refssource as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsource[$_k];
        }
        return $result;
    }
    public function ZBarcode_Encode_Segs(void_ptr | struct_zint_symbol_ptr | null | array $symbol, void_ptr | struct_zint_seg_ptr | null | array $segs, int $seg_count): int {
        $__ffi_internal_refssymbol = [];
        if (\is_array($symbol)) {
            $_ = $this->ffi->new("struct zint_symbol[" . \count($symbol) . "]");
            $_i = 0;
            foreach ($symbol as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($symbol, $_k)) {
                    $__ffi_internal_refssymbol[$_i] = &$symbol[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsymbol = $symbol = $_;
        } else {
            $symbol = $symbol?->getData();
        }
        $__ffi_internal_refssegs = [];
        if (\is_array($segs)) {
            $_ = $this->ffi->new("struct zint_seg[" . \count($segs) . "]");
            $_i = 0;
            foreach ($segs as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($segs, $_k)) {
                    $__ffi_internal_refssegs[$_i] = &$segs[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsegs = $segs = $_;
        } else {
            $segs = $segs?->getData();
        }
        $result = $this->ffi->ZBarcode_Encode_Segs($symbol, $segs, $seg_count);
        foreach ($__ffi_internal_refssymbol as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsymbol[$_k];
        }
        foreach ($__ffi_internal_refssegs as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsegs[$_k];
        }
        return $result;
    }
    public function ZBarcode_Encode_File(void_ptr | struct_zint_symbol_ptr | null | array $symbol, void_ptr | string_ | null | string | array $filename): int {
        $__ffi_internal_refssymbol = [];
        if (\is_array($symbol)) {
            $_ = $this->ffi->new("struct zint_symbol[" . \count($symbol) . "]");
            $_i = 0;
            foreach ($symbol as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($symbol, $_k)) {
                    $__ffi_internal_refssymbol[$_i] = &$symbol[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsymbol = $symbol = $_;
        } else {
            $symbol = $symbol?->getData();
        }
        $__ffi_internal_refsfilename = [];
        if (\is_string($filename)) {
            $filename = string_::ownedZero($filename)->getData();
        } elseif (\is_array($filename)) {
            $_ = $this->ffi->new("char[" . \count($filename) . "]");
            $_i = 0;
            foreach ($filename as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($filename, $_k)) {
                    $__ffi_internal_refsfilename[$_i] = &$filename[$_k];
                }
                $_[$_i++] = $_v ?? 0;
            }
            $__ffi_internal_originalfilename = $filename = $_;
        } else {
            $filename = $filename?->getData();
        }
        $result = $this->ffi->ZBarcode_Encode_File($symbol, $filename);
        foreach ($__ffi_internal_refssymbol as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsymbol[$_k];
        }
        foreach ($__ffi_internal_refsfilename as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalfilename[$_k];
        }
        return $result;
    }
    public function ZBarcode_Print(void_ptr | struct_zint_symbol_ptr | null | array $symbol, int $rotate_angle): int {
        $__ffi_internal_refssymbol = [];
        if (\is_array($symbol)) {
            $_ = $this->ffi->new("struct zint_symbol[" . \count($symbol) . "]");
            $_i = 0;
            foreach ($symbol as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($symbol, $_k)) {
                    $__ffi_internal_refssymbol[$_i] = &$symbol[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsymbol = $symbol = $_;
        } else {
            $symbol = $symbol?->getData();
        }
        $result = $this->ffi->ZBarcode_Print($symbol, $rotate_angle);
        foreach ($__ffi_internal_refssymbol as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsymbol[$_k];
        }
        return $result;
    }
    public function ZBarcode_Encode_and_Print(void_ptr | struct_zint_symbol_ptr | null | array $symbol, void_ptr | unsigned_char_ptr | null | string | array $source, int $length, int $rotate_angle): int {
        $__ffi_internal_refssymbol = [];
        if (\is_array($symbol)) {
            $_ = $this->ffi->new("struct zint_symbol[" . \count($symbol) . "]");
            $_i = 0;
            foreach ($symbol as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($symbol, $_k)) {
                    $__ffi_internal_refssymbol[$_i] = &$symbol[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsymbol = $symbol = $_;
        } else {
            $symbol = $symbol?->getData();
        }
        $__ffi_internal_refssource = [];
        if (\is_string($source)) {
            $source = string_::ownedZero($source)->getData();
        } elseif (\is_array($source)) {
            $_ = $this->ffi->new("unsigned char[" . \count($source) . "]");
            $_i = 0;
            foreach ($source as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($source, $_k)) {
                    $__ffi_internal_refssource[$_i] = &$source[$_k];
                }
                $_[$_i++] = $_v ?? 0;
            }
            $__ffi_internal_originalsource = $source = $_;
        } else {
            $source = $source?->getData();
        }
        $result = $this->ffi->ZBarcode_Encode_and_Print($symbol, $source, $length, $rotate_angle);
        foreach ($__ffi_internal_refssymbol as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsymbol[$_k];
        }
        foreach ($__ffi_internal_refssource as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsource[$_k];
        }
        return $result;
    }
    public function ZBarcode_Encode_Segs_and_Print(void_ptr | struct_zint_symbol_ptr | null | array $symbol, void_ptr | struct_zint_seg_ptr | null | array $segs, int $seg_count, int $rotate_angle): int {
        $__ffi_internal_refssymbol = [];
        if (\is_array($symbol)) {
            $_ = $this->ffi->new("struct zint_symbol[" . \count($symbol) . "]");
            $_i = 0;
            foreach ($symbol as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($symbol, $_k)) {
                    $__ffi_internal_refssymbol[$_i] = &$symbol[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsymbol = $symbol = $_;
        } else {
            $symbol = $symbol?->getData();
        }
        $__ffi_internal_refssegs = [];
        if (\is_array($segs)) {
            $_ = $this->ffi->new("struct zint_seg[" . \count($segs) . "]");
            $_i = 0;
            foreach ($segs as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($segs, $_k)) {
                    $__ffi_internal_refssegs[$_i] = &$segs[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsegs = $segs = $_;
        } else {
            $segs = $segs?->getData();
        }
        $result = $this->ffi->ZBarcode_Encode_Segs_and_Print($symbol, $segs, $seg_count, $rotate_angle);
        foreach ($__ffi_internal_refssymbol as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsymbol[$_k];
        }
        foreach ($__ffi_internal_refssegs as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsegs[$_k];
        }
        return $result;
    }
    public function ZBarcode_Encode_File_and_Print(void_ptr | struct_zint_symbol_ptr | null | array $symbol, void_ptr | string_ | null | string | array $filename, int $rotate_angle): int {
        $__ffi_internal_refssymbol = [];
        if (\is_array($symbol)) {
            $_ = $this->ffi->new("struct zint_symbol[" . \count($symbol) . "]");
            $_i = 0;
            foreach ($symbol as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($symbol, $_k)) {
                    $__ffi_internal_refssymbol[$_i] = &$symbol[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsymbol = $symbol = $_;
        } else {
            $symbol = $symbol?->getData();
        }
        $__ffi_internal_refsfilename = [];
        if (\is_string($filename)) {
            $filename = string_::ownedZero($filename)->getData();
        } elseif (\is_array($filename)) {
            $_ = $this->ffi->new("char[" . \count($filename) . "]");
            $_i = 0;
            foreach ($filename as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($filename, $_k)) {
                    $__ffi_internal_refsfilename[$_i] = &$filename[$_k];
                }
                $_[$_i++] = $_v ?? 0;
            }
            $__ffi_internal_originalfilename = $filename = $_;
        } else {
            $filename = $filename?->getData();
        }
        $result = $this->ffi->ZBarcode_Encode_File_and_Print($symbol, $filename, $rotate_angle);
        foreach ($__ffi_internal_refssymbol as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsymbol[$_k];
        }
        foreach ($__ffi_internal_refsfilename as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalfilename[$_k];
        }
        return $result;
    }
    public function ZBarcode_Buffer(void_ptr | struct_zint_symbol_ptr | null | array $symbol, int $rotate_angle): int {
        $__ffi_internal_refssymbol = [];
        if (\is_array($symbol)) {
            $_ = $this->ffi->new("struct zint_symbol[" . \count($symbol) . "]");
            $_i = 0;
            foreach ($symbol as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($symbol, $_k)) {
                    $__ffi_internal_refssymbol[$_i] = &$symbol[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsymbol = $symbol = $_;
        } else {
            $symbol = $symbol?->getData();
        }
        $result = $this->ffi->ZBarcode_Buffer($symbol, $rotate_angle);
        foreach ($__ffi_internal_refssymbol as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsymbol[$_k];
        }
        return $result;
    }
    public function ZBarcode_Encode_and_Buffer(void_ptr | struct_zint_symbol_ptr | null | array $symbol, void_ptr | unsigned_char_ptr | null | string | array $source, int $length, int $rotate_angle): int {
        $__ffi_internal_refssymbol = [];
        if (\is_array($symbol)) {
            $_ = $this->ffi->new("struct zint_symbol[" . \count($symbol) . "]");
            $_i = 0;
            foreach ($symbol as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($symbol, $_k)) {
                    $__ffi_internal_refssymbol[$_i] = &$symbol[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsymbol = $symbol = $_;
        } else {
            $symbol = $symbol?->getData();
        }
        $__ffi_internal_refssource = [];
        if (\is_string($source)) {
            $source = string_::ownedZero($source)->getData();
        } elseif (\is_array($source)) {
            $_ = $this->ffi->new("unsigned char[" . \count($source) . "]");
            $_i = 0;
            foreach ($source as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($source, $_k)) {
                    $__ffi_internal_refssource[$_i] = &$source[$_k];
                }
                $_[$_i++] = $_v ?? 0;
            }
            $__ffi_internal_originalsource = $source = $_;
        } else {
            $source = $source?->getData();
        }
        $result = $this->ffi->ZBarcode_Encode_and_Buffer($symbol, $source, $length, $rotate_angle);
        foreach ($__ffi_internal_refssymbol as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsymbol[$_k];
        }
        foreach ($__ffi_internal_refssource as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsource[$_k];
        }
        return $result;
    }
    public function ZBarcode_Encode_Segs_and_Buffer(void_ptr | struct_zint_symbol_ptr | null | array $symbol, void_ptr | struct_zint_seg_ptr | null | array $segs, int $seg_count, int $rotate_angle): int {
        $__ffi_internal_refssymbol = [];
        if (\is_array($symbol)) {
            $_ = $this->ffi->new("struct zint_symbol[" . \count($symbol) . "]");
            $_i = 0;
            foreach ($symbol as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($symbol, $_k)) {
                    $__ffi_internal_refssymbol[$_i] = &$symbol[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsymbol = $symbol = $_;
        } else {
            $symbol = $symbol?->getData();
        }
        $__ffi_internal_refssegs = [];
        if (\is_array($segs)) {
            $_ = $this->ffi->new("struct zint_seg[" . \count($segs) . "]");
            $_i = 0;
            foreach ($segs as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($segs, $_k)) {
                    $__ffi_internal_refssegs[$_i] = &$segs[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsegs = $segs = $_;
        } else {
            $segs = $segs?->getData();
        }
        $result = $this->ffi->ZBarcode_Encode_Segs_and_Buffer($symbol, $segs, $seg_count, $rotate_angle);
        foreach ($__ffi_internal_refssymbol as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsymbol[$_k];
        }
        foreach ($__ffi_internal_refssegs as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsegs[$_k];
        }
        return $result;
    }
    public function ZBarcode_Encode_File_and_Buffer(void_ptr | struct_zint_symbol_ptr | null | array $symbol, void_ptr | string_ | null | string | array $filename, int $rotate_angle): int {
        $__ffi_internal_refssymbol = [];
        if (\is_array($symbol)) {
            $_ = $this->ffi->new("struct zint_symbol[" . \count($symbol) . "]");
            $_i = 0;
            foreach ($symbol as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($symbol, $_k)) {
                    $__ffi_internal_refssymbol[$_i] = &$symbol[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsymbol = $symbol = $_;
        } else {
            $symbol = $symbol?->getData();
        }
        $__ffi_internal_refsfilename = [];
        if (\is_string($filename)) {
            $filename = string_::ownedZero($filename)->getData();
        } elseif (\is_array($filename)) {
            $_ = $this->ffi->new("char[" . \count($filename) . "]");
            $_i = 0;
            foreach ($filename as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($filename, $_k)) {
                    $__ffi_internal_refsfilename[$_i] = &$filename[$_k];
                }
                $_[$_i++] = $_v ?? 0;
            }
            $__ffi_internal_originalfilename = $filename = $_;
        } else {
            $filename = $filename?->getData();
        }
        $result = $this->ffi->ZBarcode_Encode_File_and_Buffer($symbol, $filename, $rotate_angle);
        foreach ($__ffi_internal_refssymbol as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsymbol[$_k];
        }
        foreach ($__ffi_internal_refsfilename as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalfilename[$_k];
        }
        return $result;
    }
    public function ZBarcode_Buffer_Vector(void_ptr | struct_zint_symbol_ptr | null | array $symbol, int $rotate_angle): int {
        $__ffi_internal_refssymbol = [];
        if (\is_array($symbol)) {
            $_ = $this->ffi->new("struct zint_symbol[" . \count($symbol) . "]");
            $_i = 0;
            foreach ($symbol as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($symbol, $_k)) {
                    $__ffi_internal_refssymbol[$_i] = &$symbol[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsymbol = $symbol = $_;
        } else {
            $symbol = $symbol?->getData();
        }
        $result = $this->ffi->ZBarcode_Buffer_Vector($symbol, $rotate_angle);
        foreach ($__ffi_internal_refssymbol as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsymbol[$_k];
        }
        return $result;
    }
    public function ZBarcode_Encode_and_Buffer_Vector(void_ptr | struct_zint_symbol_ptr | null | array $symbol, void_ptr | unsigned_char_ptr | null | string | array $source, int $length, int $rotate_angle): int {
        $__ffi_internal_refssymbol = [];
        if (\is_array($symbol)) {
            $_ = $this->ffi->new("struct zint_symbol[" . \count($symbol) . "]");
            $_i = 0;
            foreach ($symbol as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($symbol, $_k)) {
                    $__ffi_internal_refssymbol[$_i] = &$symbol[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsymbol = $symbol = $_;
        } else {
            $symbol = $symbol?->getData();
        }
        $__ffi_internal_refssource = [];
        if (\is_string($source)) {
            $source = string_::ownedZero($source)->getData();
        } elseif (\is_array($source)) {
            $_ = $this->ffi->new("unsigned char[" . \count($source) . "]");
            $_i = 0;
            foreach ($source as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($source, $_k)) {
                    $__ffi_internal_refssource[$_i] = &$source[$_k];
                }
                $_[$_i++] = $_v ?? 0;
            }
            $__ffi_internal_originalsource = $source = $_;
        } else {
            $source = $source?->getData();
        }
        $result = $this->ffi->ZBarcode_Encode_and_Buffer_Vector($symbol, $source, $length, $rotate_angle);
        foreach ($__ffi_internal_refssymbol as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsymbol[$_k];
        }
        foreach ($__ffi_internal_refssource as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsource[$_k];
        }
        return $result;
    }
    public function ZBarcode_Encode_Segs_and_Buffer_Vector(void_ptr | struct_zint_symbol_ptr | null | array $symbol, void_ptr | struct_zint_seg_ptr | null | array $segs, int $seg_count, int $rotate_angle): int {
        $__ffi_internal_refssymbol = [];
        if (\is_array($symbol)) {
            $_ = $this->ffi->new("struct zint_symbol[" . \count($symbol) . "]");
            $_i = 0;
            foreach ($symbol as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($symbol, $_k)) {
                    $__ffi_internal_refssymbol[$_i] = &$symbol[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsymbol = $symbol = $_;
        } else {
            $symbol = $symbol?->getData();
        }
        $__ffi_internal_refssegs = [];
        if (\is_array($segs)) {
            $_ = $this->ffi->new("struct zint_seg[" . \count($segs) . "]");
            $_i = 0;
            foreach ($segs as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($segs, $_k)) {
                    $__ffi_internal_refssegs[$_i] = &$segs[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsegs = $segs = $_;
        } else {
            $segs = $segs?->getData();
        }
        $result = $this->ffi->ZBarcode_Encode_Segs_and_Buffer_Vector($symbol, $segs, $seg_count, $rotate_angle);
        foreach ($__ffi_internal_refssymbol as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsymbol[$_k];
        }
        foreach ($__ffi_internal_refssegs as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsegs[$_k];
        }
        return $result;
    }
    public function ZBarcode_Encode_File_and_Buffer_Vector(void_ptr | struct_zint_symbol_ptr | null | array $symbol, void_ptr | string_ | null | string | array $filename, int $rotate_angle): int {
        $__ffi_internal_refssymbol = [];
        if (\is_array($symbol)) {
            $_ = $this->ffi->new("struct zint_symbol[" . \count($symbol) . "]");
            $_i = 0;
            foreach ($symbol as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($symbol, $_k)) {
                    $__ffi_internal_refssymbol[$_i] = &$symbol[$_k];
                }
                $_[$_i++] = $_v?->getData();
            }
            $__ffi_internal_originalsymbol = $symbol = $_;
        } else {
            $symbol = $symbol?->getData();
        }
        $__ffi_internal_refsfilename = [];
        if (\is_string($filename)) {
            $filename = string_::ownedZero($filename)->getData();
        } elseif (\is_array($filename)) {
            $_ = $this->ffi->new("char[" . \count($filename) . "]");
            $_i = 0;
            foreach ($filename as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($filename, $_k)) {
                    $__ffi_internal_refsfilename[$_i] = &$filename[$_k];
                }
                $_[$_i++] = $_v ?? 0;
            }
            $__ffi_internal_originalfilename = $filename = $_;
        } else {
            $filename = $filename?->getData();
        }
        $result = $this->ffi->ZBarcode_Encode_File_and_Buffer_Vector($symbol, $filename, $rotate_angle);
        foreach ($__ffi_internal_refssymbol as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalsymbol[$_k];
        }
        foreach ($__ffi_internal_refsfilename as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalfilename[$_k];
        }
        return $result;
    }
    public function ZBarcode_ValidID(int $symbol_id): int {
        $result = $this->ffi->ZBarcode_ValidID($symbol_id);
        return $result;
    }
    public function ZBarcode_BarcodeName(int $symbol_id, void_ptr | string_ | null | string | array $name): int {
        $__ffi_internal_refsname = [];
        if (\is_string($name)) {
            $name = string_::ownedZero($name)->getData();
        } elseif (\is_array($name)) {
            $_ = $this->ffi->new("char[" . \count($name) . "]");
            $_i = 0;
            foreach ($name as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($name, $_k)) {
                    $__ffi_internal_refsname[$_i] = &$name[$_k];
                }
                $_[$_i++] = $_v ?? 0;
            }
            $__ffi_internal_originalname = $name = $_;
        } else {
            $name = $name?->getData();
        }
        $result = $this->ffi->ZBarcode_BarcodeName($symbol_id, $name);
        foreach ($__ffi_internal_refsname as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalname[$_k];
        }
        return $result;
    }
    public function ZBarcode_Cap(int $symbol_id, int $cap_flag): int {
        $result = $this->ffi->ZBarcode_Cap($symbol_id, $cap_flag);
        return $result;
    }
    public function ZBarcode_Default_Xdim(int $symbol_id): float {
        $result = $this->ffi->ZBarcode_Default_Xdim($symbol_id);
        return $result;
    }
    public function ZBarcode_Scale_From_XdimDp(int $symbol_id, float $x_dim_mm, float $dpmm, void_ptr | string_ | null | string | array $filetype): float {
        $__ffi_internal_refsfiletype = [];
        if (\is_string($filetype)) {
            $filetype = string_::ownedZero($filetype)->getData();
        } elseif (\is_array($filetype)) {
            $_ = $this->ffi->new("char[" . \count($filetype) . "]");
            $_i = 0;
            foreach ($filetype as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($filetype, $_k)) {
                    $__ffi_internal_refsfiletype[$_i] = &$filetype[$_k];
                }
                $_[$_i++] = $_v ?? 0;
            }
            $__ffi_internal_originalfiletype = $filetype = $_;
        } else {
            $filetype = $filetype?->getData();
        }
        $result = $this->ffi->ZBarcode_Scale_From_XdimDp($symbol_id, $x_dim_mm, $dpmm, $filetype);
        foreach ($__ffi_internal_refsfiletype as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalfiletype[$_k];
        }
        return $result;
    }
    public function ZBarcode_XdimDp_From_Scale(int $symbol_id, float $scale, float $x_dim_mm_or_dpmm, void_ptr | string_ | null | string | array $filetype): float {
        $__ffi_internal_refsfiletype = [];
        if (\is_string($filetype)) {
            $filetype = string_::ownedZero($filetype)->getData();
        } elseif (\is_array($filetype)) {
            $_ = $this->ffi->new("char[" . \count($filetype) . "]");
            $_i = 0;
            foreach ($filetype as $_k => $_v) {
                if ($_ref = \ReflectionReference::fromArrayElement($filetype, $_k)) {
                    $__ffi_internal_refsfiletype[$_i] = &$filetype[$_k];
                }
                $_[$_i++] = $_v ?? 0;
            }
            $__ffi_internal_originalfiletype = $filetype = $_;
        } else {
            $filetype = $filetype?->getData();
        }
        $result = $this->ffi->ZBarcode_XdimDp_From_Scale($symbol_id, $scale, $x_dim_mm_or_dpmm, $filetype);
        foreach ($__ffi_internal_refsfiletype as $_k => &$__ffi_internal_ref_v) {
            $__ffi_internal_ref_v = $__ffi_internal_originalfiletype[$_k];
        }
        return $result;
    }
    public function ZBarcode_NoPng(): int {
        $result = $this->ffi->ZBarcode_NoPng();
        return $result;
    }
    public function ZBarcode_Version(): int {
        $result = $this->ffi->ZBarcode_Version();
        return $result;
    }
}
(function() { self::$staticFFI = \FFI::cdef(Zint::TYPES_DEF); })->bindTo(null, Zint::class)();

class string_ implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(string_ $other): bool { return $this->data == $other->data; }
    public function addr(): string_ptr { return new string_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): int { return \ord($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): int { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = \chr($value); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return int[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while ("\0" !== $cur = $this->data[$i++]) { $ret[] = \ord($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = \ord($this->data[$i]); } } return $ret; }
    public function toString(?int $length = null): string { return $length === null ? FFI::string($this->data) : FFI::string($this->data, $length); }
    public static function persistent(string $string): self { $str = new self(FFI::new("char[" . \strlen($string) . "]", false)); FFI::memcpy($str->data, $string, \strlen($string)); return $str; }
    public static function owned(string $string): self { $str = new self(FFI::new("char[" . \strlen($string) . "]", true)); FFI::memcpy($str->data, $string, \strlen($string)); return $str; }
    public static function persistentZero(string $string): self { return self::persistent("$string\0"); }
    public static function ownedZero(string $string): self { return self::owned("$string\0"); }
    public function set(int | void_ptr | string_ $value): void {
        if (\is_scalar($value)) {
            $this->data[0] = \chr($value);
        } else {
            FFI::addr($this->data)[0] = $value->getData();
        }
    }
    public static function getType(): string { return 'char*'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class string_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(string_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): string_ptr_ptr { return new string_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): string_ { return new string_($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): string_ { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return string_[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new string_($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new string_($this->data[$i]); } } return $ret; }
    public function set(void_ptr | string_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'char**'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class string_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(string_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): string_ptr_ptr_ptr { return new string_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): string_ptr { return new string_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): string_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return string_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new string_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new string_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | string_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'char***'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class string_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(string_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): string_ptr_ptr_ptr_ptr { return new string_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): string_ptr_ptr { return new string_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): string_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return string_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new string_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new string_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | string_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'char***'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class void_ptr implements iZint, iZint_ptr {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(void_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): void_ptr_ptr { return new void_ptr_ptr(FFI::addr($this->data)); }
    public function set(iZint_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'void*'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class void_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(void_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): void_ptr_ptr_ptr { return new void_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): void_ptr { return new void_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): void_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return void_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new void_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new void_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | void_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'void**'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class void_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(void_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): void_ptr_ptr_ptr_ptr { return new void_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): void_ptr_ptr { return new void_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): void_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return void_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new void_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new void_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | void_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'void***'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class void_ptr_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(void_ptr_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): void_ptr_ptr_ptr_ptr_ptr { return new void_ptr_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): void_ptr_ptr_ptr { return new void_ptr_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): void_ptr_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return void_ptr_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new void_ptr_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new void_ptr_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | void_ptr_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'void****'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
/**
 * @property float $x
 * @property float $y
 * @property float $height
 * @property float $width
 * @property int $colour
 * @property struct_zint_vector_rect_ptr $next
 */
class struct_zint_vector_rect implements iZint {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_rect $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_rect_ptr { return new struct_zint_vector_rect_ptr(FFI::addr($this->data)); }
    public function __get($prop) {
        switch ($prop) {
            case "x": return $this->data->x;
            case "y": return $this->data->y;
            case "height": return $this->data->height;
            case "width": return $this->data->width;
            case "colour": return $this->data->colour;
            case "next": return new struct_zint_vector_rect_ptr($this->data->next);
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function __set($prop, $value) {
        switch ($prop) {
            case "x":
                $this->data->x = $value;
                return;
            case "y":
                $this->data->y = $value;
                return;
            case "height":
                $this->data->height = $value;
                return;
            case "width":
                $this->data->width = $value;
                return;
            case "colour":
                $this->data->colour = $value;
                return;
            case "next":
                (new struct_zint_vector_rect_ptr($this->data->next))->set($value);
                return;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function set(struct_zint_vector_rect $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_rect'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
/**
 * @property float $x
 * @property float $y
 * @property float $height
 * @property float $width
 * @property int $colour
 * @property struct_zint_vector_rect_ptr $next
 */
class struct_zint_vector_rect_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_rect_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_rect_ptr_ptr { return new struct_zint_vector_rect_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_rect { return new struct_zint_vector_rect($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_rect { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_rect[] */ public function toArray(int $length): array { $ret = []; for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_rect($this->data[$i]); } return $ret; }
    public function __get($prop) {
        switch ($prop) {
            case "x": return $this->data[0]->x;
            case "y": return $this->data[0]->y;
            case "height": return $this->data[0]->height;
            case "width": return $this->data[0]->width;
            case "colour": return $this->data[0]->colour;
            case "next": return new struct_zint_vector_rect_ptr($this->data[0]->next);
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function __set($prop, $value) {
        switch ($prop) {
            case "x":
                $this->data[0]->x = $value;
                return;
            case "y":
                $this->data[0]->y = $value;
                return;
            case "height":
                $this->data[0]->height = $value;
                return;
            case "width":
                $this->data[0]->width = $value;
                return;
            case "colour":
                $this->data[0]->colour = $value;
                return;
            case "next":
                (new struct_zint_vector_rect_ptr($this->data[0]->next))->set($value);
                return;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function set(void_ptr | struct_zint_vector_rect_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_rect*'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_vector_rect_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_rect_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_rect_ptr_ptr_ptr { return new struct_zint_vector_rect_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_rect_ptr { return new struct_zint_vector_rect_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_rect_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_rect_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_vector_rect_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_rect_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_vector_rect_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_rect**'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_vector_rect_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_rect_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_rect_ptr_ptr_ptr_ptr { return new struct_zint_vector_rect_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_rect_ptr_ptr { return new struct_zint_vector_rect_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_rect_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_rect_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_vector_rect_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_rect_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_vector_rect_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_rect***'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_vector_rect_ptr_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_rect_ptr_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_rect_ptr_ptr_ptr_ptr_ptr { return new struct_zint_vector_rect_ptr_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_rect_ptr_ptr_ptr { return new struct_zint_vector_rect_ptr_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_rect_ptr_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_rect_ptr_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_vector_rect_ptr_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_rect_ptr_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_vector_rect_ptr_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_rect****'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
/**
 * @property float $x
 * @property float $y
 * @property float $diameter
 * @property int $rotation
 * @property struct_zint_vector_hexagon_ptr $next
 */
class struct_zint_vector_hexagon implements iZint {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_hexagon $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_hexagon_ptr { return new struct_zint_vector_hexagon_ptr(FFI::addr($this->data)); }
    public function __get($prop) {
        switch ($prop) {
            case "x": return $this->data->x;
            case "y": return $this->data->y;
            case "diameter": return $this->data->diameter;
            case "rotation": return $this->data->rotation;
            case "next": return new struct_zint_vector_hexagon_ptr($this->data->next);
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function __set($prop, $value) {
        switch ($prop) {
            case "x":
                $this->data->x = $value;
                return;
            case "y":
                $this->data->y = $value;
                return;
            case "diameter":
                $this->data->diameter = $value;
                return;
            case "rotation":
                $this->data->rotation = $value;
                return;
            case "next":
                (new struct_zint_vector_hexagon_ptr($this->data->next))->set($value);
                return;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function set(struct_zint_vector_hexagon $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_hexagon'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
/**
 * @property float $x
 * @property float $y
 * @property float $diameter
 * @property int $rotation
 * @property struct_zint_vector_hexagon_ptr $next
 */
class struct_zint_vector_hexagon_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_hexagon_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_hexagon_ptr_ptr { return new struct_zint_vector_hexagon_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_hexagon { return new struct_zint_vector_hexagon($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_hexagon { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_hexagon[] */ public function toArray(int $length): array { $ret = []; for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_hexagon($this->data[$i]); } return $ret; }
    public function __get($prop) {
        switch ($prop) {
            case "x": return $this->data[0]->x;
            case "y": return $this->data[0]->y;
            case "diameter": return $this->data[0]->diameter;
            case "rotation": return $this->data[0]->rotation;
            case "next": return new struct_zint_vector_hexagon_ptr($this->data[0]->next);
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function __set($prop, $value) {
        switch ($prop) {
            case "x":
                $this->data[0]->x = $value;
                return;
            case "y":
                $this->data[0]->y = $value;
                return;
            case "diameter":
                $this->data[0]->diameter = $value;
                return;
            case "rotation":
                $this->data[0]->rotation = $value;
                return;
            case "next":
                (new struct_zint_vector_hexagon_ptr($this->data[0]->next))->set($value);
                return;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function set(void_ptr | struct_zint_vector_hexagon_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_hexagon*'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_vector_hexagon_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_hexagon_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_hexagon_ptr_ptr_ptr { return new struct_zint_vector_hexagon_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_hexagon_ptr { return new struct_zint_vector_hexagon_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_hexagon_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_hexagon_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_vector_hexagon_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_hexagon_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_vector_hexagon_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_hexagon**'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_vector_hexagon_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_hexagon_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_hexagon_ptr_ptr_ptr_ptr { return new struct_zint_vector_hexagon_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_hexagon_ptr_ptr { return new struct_zint_vector_hexagon_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_hexagon_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_hexagon_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_vector_hexagon_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_hexagon_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_vector_hexagon_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_hexagon***'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_vector_hexagon_ptr_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_hexagon_ptr_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_hexagon_ptr_ptr_ptr_ptr_ptr { return new struct_zint_vector_hexagon_ptr_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_hexagon_ptr_ptr_ptr { return new struct_zint_vector_hexagon_ptr_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_hexagon_ptr_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_hexagon_ptr_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_vector_hexagon_ptr_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_hexagon_ptr_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_vector_hexagon_ptr_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_hexagon****'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
/**
 * @property float $x
 * @property float $y
 * @property float $fsize
 * @property float $width
 * @property int $length
 * @property int $rotation
 * @property int $halign
 * @property unsigned_char_ptr $text
 * @property struct_zint_vector_string_ptr $next
 */
class struct_zint_vector_string implements iZint {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_string $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_string_ptr { return new struct_zint_vector_string_ptr(FFI::addr($this->data)); }
    public function __get($prop) {
        switch ($prop) {
            case "x": return $this->data->x;
            case "y": return $this->data->y;
            case "fsize": return $this->data->fsize;
            case "width": return $this->data->width;
            case "length": return $this->data->length;
            case "rotation": return $this->data->rotation;
            case "halign": return $this->data->halign;
            case "text": return new unsigned_char_ptr($this->data->text);
            case "next": return new struct_zint_vector_string_ptr($this->data->next);
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function __set($prop, $value) {
        switch ($prop) {
            case "x":
                $this->data->x = $value;
                return;
            case "y":
                $this->data->y = $value;
                return;
            case "fsize":
                $this->data->fsize = $value;
                return;
            case "width":
                $this->data->width = $value;
                return;
            case "length":
                $this->data->length = $value;
                return;
            case "rotation":
                $this->data->rotation = $value;
                return;
            case "halign":
                $this->data->halign = $value;
                return;
            case "text":
                (new unsigned_char_ptr($this->data->text))->set($value);
                return;
            case "next":
                (new struct_zint_vector_string_ptr($this->data->next))->set($value);
                return;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function set(struct_zint_vector_string $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_string'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
/**
 * @property float $x
 * @property float $y
 * @property float $fsize
 * @property float $width
 * @property int $length
 * @property int $rotation
 * @property int $halign
 * @property unsigned_char_ptr $text
 * @property struct_zint_vector_string_ptr $next
 */
class struct_zint_vector_string_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_string_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_string_ptr_ptr { return new struct_zint_vector_string_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_string { return new struct_zint_vector_string($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_string { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_string[] */ public function toArray(int $length): array { $ret = []; for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_string($this->data[$i]); } return $ret; }
    public function __get($prop) {
        switch ($prop) {
            case "x": return $this->data[0]->x;
            case "y": return $this->data[0]->y;
            case "fsize": return $this->data[0]->fsize;
            case "width": return $this->data[0]->width;
            case "length": return $this->data[0]->length;
            case "rotation": return $this->data[0]->rotation;
            case "halign": return $this->data[0]->halign;
            case "text": return new unsigned_char_ptr($this->data[0]->text);
            case "next": return new struct_zint_vector_string_ptr($this->data[0]->next);
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function __set($prop, $value) {
        switch ($prop) {
            case "x":
                $this->data[0]->x = $value;
                return;
            case "y":
                $this->data[0]->y = $value;
                return;
            case "fsize":
                $this->data[0]->fsize = $value;
                return;
            case "width":
                $this->data[0]->width = $value;
                return;
            case "length":
                $this->data[0]->length = $value;
                return;
            case "rotation":
                $this->data[0]->rotation = $value;
                return;
            case "halign":
                $this->data[0]->halign = $value;
                return;
            case "text":
                (new unsigned_char_ptr($this->data[0]->text))->set($value);
                return;
            case "next":
                (new struct_zint_vector_string_ptr($this->data[0]->next))->set($value);
                return;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function set(void_ptr | struct_zint_vector_string_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_string*'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_vector_string_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_string_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_string_ptr_ptr_ptr { return new struct_zint_vector_string_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_string_ptr { return new struct_zint_vector_string_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_string_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_string_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_vector_string_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_string_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_vector_string_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_string**'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_vector_string_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_string_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_string_ptr_ptr_ptr_ptr { return new struct_zint_vector_string_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_string_ptr_ptr { return new struct_zint_vector_string_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_string_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_string_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_vector_string_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_string_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_vector_string_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_string***'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_vector_string_ptr_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_string_ptr_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_string_ptr_ptr_ptr_ptr_ptr { return new struct_zint_vector_string_ptr_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_string_ptr_ptr_ptr { return new struct_zint_vector_string_ptr_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_string_ptr_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_string_ptr_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_vector_string_ptr_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_string_ptr_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_vector_string_ptr_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_string****'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
/**
 * @property float $x
 * @property float $y
 * @property float $diameter
 * @property float $width
 * @property int $colour
 * @property struct_zint_vector_circle_ptr $next
 */
class struct_zint_vector_circle implements iZint {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_circle $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_circle_ptr { return new struct_zint_vector_circle_ptr(FFI::addr($this->data)); }
    public function __get($prop) {
        switch ($prop) {
            case "x": return $this->data->x;
            case "y": return $this->data->y;
            case "diameter": return $this->data->diameter;
            case "width": return $this->data->width;
            case "colour": return $this->data->colour;
            case "next": return new struct_zint_vector_circle_ptr($this->data->next);
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function __set($prop, $value) {
        switch ($prop) {
            case "x":
                $this->data->x = $value;
                return;
            case "y":
                $this->data->y = $value;
                return;
            case "diameter":
                $this->data->diameter = $value;
                return;
            case "width":
                $this->data->width = $value;
                return;
            case "colour":
                $this->data->colour = $value;
                return;
            case "next":
                (new struct_zint_vector_circle_ptr($this->data->next))->set($value);
                return;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function set(struct_zint_vector_circle $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_circle'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
/**
 * @property float $x
 * @property float $y
 * @property float $diameter
 * @property float $width
 * @property int $colour
 * @property struct_zint_vector_circle_ptr $next
 */
class struct_zint_vector_circle_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_circle_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_circle_ptr_ptr { return new struct_zint_vector_circle_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_circle { return new struct_zint_vector_circle($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_circle { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_circle[] */ public function toArray(int $length): array { $ret = []; for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_circle($this->data[$i]); } return $ret; }
    public function __get($prop) {
        switch ($prop) {
            case "x": return $this->data[0]->x;
            case "y": return $this->data[0]->y;
            case "diameter": return $this->data[0]->diameter;
            case "width": return $this->data[0]->width;
            case "colour": return $this->data[0]->colour;
            case "next": return new struct_zint_vector_circle_ptr($this->data[0]->next);
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function __set($prop, $value) {
        switch ($prop) {
            case "x":
                $this->data[0]->x = $value;
                return;
            case "y":
                $this->data[0]->y = $value;
                return;
            case "diameter":
                $this->data[0]->diameter = $value;
                return;
            case "width":
                $this->data[0]->width = $value;
                return;
            case "colour":
                $this->data[0]->colour = $value;
                return;
            case "next":
                (new struct_zint_vector_circle_ptr($this->data[0]->next))->set($value);
                return;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function set(void_ptr | struct_zint_vector_circle_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_circle*'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_vector_circle_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_circle_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_circle_ptr_ptr_ptr { return new struct_zint_vector_circle_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_circle_ptr { return new struct_zint_vector_circle_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_circle_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_circle_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_vector_circle_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_circle_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_vector_circle_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_circle**'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_vector_circle_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_circle_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_circle_ptr_ptr_ptr_ptr { return new struct_zint_vector_circle_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_circle_ptr_ptr { return new struct_zint_vector_circle_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_circle_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_circle_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_vector_circle_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_circle_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_vector_circle_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_circle***'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_vector_circle_ptr_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_circle_ptr_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_circle_ptr_ptr_ptr_ptr_ptr { return new struct_zint_vector_circle_ptr_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_circle_ptr_ptr_ptr { return new struct_zint_vector_circle_ptr_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_circle_ptr_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_circle_ptr_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_vector_circle_ptr_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_circle_ptr_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_vector_circle_ptr_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector_circle****'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
/**
 * @property float $width
 * @property float $height
 * @property struct_zint_vector_rect_ptr $rectangles
 * @property struct_zint_vector_hexagon_ptr $hexagons
 * @property struct_zint_vector_string_ptr $strings
 * @property struct_zint_vector_circle_ptr $circles
 */
class struct_zint_vector implements iZint {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_ptr { return new struct_zint_vector_ptr(FFI::addr($this->data)); }
    public function __get($prop) {
        switch ($prop) {
            case "width": return $this->data->width;
            case "height": return $this->data->height;
            case "rectangles": return new struct_zint_vector_rect_ptr($this->data->rectangles);
            case "hexagons": return new struct_zint_vector_hexagon_ptr($this->data->hexagons);
            case "strings": return new struct_zint_vector_string_ptr($this->data->strings);
            case "circles": return new struct_zint_vector_circle_ptr($this->data->circles);
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function __set($prop, $value) {
        switch ($prop) {
            case "width":
                $this->data->width = $value;
                return;
            case "height":
                $this->data->height = $value;
                return;
            case "rectangles":
                (new struct_zint_vector_rect_ptr($this->data->rectangles))->set($value);
                return;
            case "hexagons":
                (new struct_zint_vector_hexagon_ptr($this->data->hexagons))->set($value);
                return;
            case "strings":
                (new struct_zint_vector_string_ptr($this->data->strings))->set($value);
                return;
            case "circles":
                (new struct_zint_vector_circle_ptr($this->data->circles))->set($value);
                return;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function set(struct_zint_vector $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
/**
 * @property float $width
 * @property float $height
 * @property struct_zint_vector_rect_ptr $rectangles
 * @property struct_zint_vector_hexagon_ptr $hexagons
 * @property struct_zint_vector_string_ptr $strings
 * @property struct_zint_vector_circle_ptr $circles
 */
class struct_zint_vector_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_ptr_ptr { return new struct_zint_vector_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector { return new struct_zint_vector($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector[] */ public function toArray(int $length): array { $ret = []; for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector($this->data[$i]); } return $ret; }
    public function __get($prop) {
        switch ($prop) {
            case "width": return $this->data[0]->width;
            case "height": return $this->data[0]->height;
            case "rectangles": return new struct_zint_vector_rect_ptr($this->data[0]->rectangles);
            case "hexagons": return new struct_zint_vector_hexagon_ptr($this->data[0]->hexagons);
            case "strings": return new struct_zint_vector_string_ptr($this->data[0]->strings);
            case "circles": return new struct_zint_vector_circle_ptr($this->data[0]->circles);
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function __set($prop, $value) {
        switch ($prop) {
            case "width":
                $this->data[0]->width = $value;
                return;
            case "height":
                $this->data[0]->height = $value;
                return;
            case "rectangles":
                (new struct_zint_vector_rect_ptr($this->data[0]->rectangles))->set($value);
                return;
            case "hexagons":
                (new struct_zint_vector_hexagon_ptr($this->data[0]->hexagons))->set($value);
                return;
            case "strings":
                (new struct_zint_vector_string_ptr($this->data[0]->strings))->set($value);
                return;
            case "circles":
                (new struct_zint_vector_circle_ptr($this->data[0]->circles))->set($value);
                return;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function set(void_ptr | struct_zint_vector_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector*'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_vector_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_ptr_ptr_ptr { return new struct_zint_vector_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_ptr { return new struct_zint_vector_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_vector_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_vector_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector**'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_vector_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_ptr_ptr_ptr_ptr { return new struct_zint_vector_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_ptr_ptr { return new struct_zint_vector_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_vector_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_vector_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector***'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_vector_ptr_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_vector_ptr_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_vector_ptr_ptr_ptr_ptr_ptr { return new struct_zint_vector_ptr_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_vector_ptr_ptr_ptr { return new struct_zint_vector_ptr_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_vector_ptr_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_vector_ptr_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_vector_ptr_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_vector_ptr_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_vector_ptr_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_vector****'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
/**
 * @property int $index
 * @property int $count
 * @property string_ $id
 */
class struct_zint_structapp implements iZint {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_structapp $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_structapp_ptr { return new struct_zint_structapp_ptr(FFI::addr($this->data)); }
    public function __get($prop) {
        switch ($prop) {
            case "index": return $this->data->index;
            case "count": return $this->data->count;
            case "id": return new string_($this->data->id);
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function __set($prop, $value) {
        switch ($prop) {
            case "index":
                $this->data->index = $value;
                return;
            case "count":
                $this->data->count = $value;
                return;
            case "id":
                (new string_($this->data->id))->set($value);
                return;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function set(struct_zint_structapp $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_structapp'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
/**
 * @property int $index
 * @property int $count
 * @property string_ $id
 */
class struct_zint_structapp_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_structapp_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_structapp_ptr_ptr { return new struct_zint_structapp_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_structapp { return new struct_zint_structapp($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_structapp { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_structapp[] */ public function toArray(int $length): array { $ret = []; for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_structapp($this->data[$i]); } return $ret; }
    public function __get($prop) {
        switch ($prop) {
            case "index": return $this->data[0]->index;
            case "count": return $this->data[0]->count;
            case "id": return new string_($this->data[0]->id);
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function __set($prop, $value) {
        switch ($prop) {
            case "index":
                $this->data[0]->index = $value;
                return;
            case "count":
                $this->data[0]->count = $value;
                return;
            case "id":
                (new string_($this->data[0]->id))->set($value);
                return;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function set(void_ptr | struct_zint_structapp_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_structapp*'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_structapp_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_structapp_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_structapp_ptr_ptr_ptr { return new struct_zint_structapp_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_structapp_ptr { return new struct_zint_structapp_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_structapp_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_structapp_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_structapp_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_structapp_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_structapp_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_structapp**'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_structapp_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_structapp_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_structapp_ptr_ptr_ptr_ptr { return new struct_zint_structapp_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_structapp_ptr_ptr { return new struct_zint_structapp_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_structapp_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_structapp_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_structapp_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_structapp_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_structapp_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_structapp***'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_structapp_ptr_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_structapp_ptr_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_structapp_ptr_ptr_ptr_ptr_ptr { return new struct_zint_structapp_ptr_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_structapp_ptr_ptr_ptr { return new struct_zint_structapp_ptr_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_structapp_ptr_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_structapp_ptr_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_structapp_ptr_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_structapp_ptr_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_structapp_ptr_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_structapp****'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
/**
 * @property int $symbology
 * @property float $height
 * @property float $scale
 * @property int $whitespace_width
 * @property int $whitespace_height
 * @property int $border_width
 * @property int $output_options
 * @property string_ $fgcolour
 * @property string_ $bgcolour
 * @property string_ $fgcolor
 * @property string_ $bgcolor
 * @property string_ $outfile
 * @property string_ $primary
 * @property int $option_1
 * @property int $option_2
 * @property int $option_3
 * @property int $show_hrt
 * @property int $fontsize
 * @property int $input_mode
 * @property int $eci
 * @property float $dpmm
 * @property float $dot_size
 * @property float $text_gap
 * @property float $guard_descent
 * @property struct_zint_structapp $structapp
 * @property int $warn_level
 * @property int $debug
 * @property unsigned_char_ptr $text
 * @property int $rows
 * @property int $width
 * @property unsigned_char_ptr_ptr $encoded_data
 * @property float_ptr $row_height
 * @property string_ $errtxt
 * @property unsigned_char_ptr $bitmap
 * @property int $bitmap_width
 * @property int $bitmap_height
 * @property unsigned_char_ptr $alphamap
 * @property int $bitmap_byte_length
 * @property struct_zint_vector_ptr $vector
 */
class struct_zint_symbol implements iZint {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_symbol $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_symbol_ptr { return new struct_zint_symbol_ptr(FFI::addr($this->data)); }
    public function __get($prop) {
        switch ($prop) {
            case "symbology": return $this->data->symbology;
            case "height": return $this->data->height;
            case "scale": return $this->data->scale;
            case "whitespace_width": return $this->data->whitespace_width;
            case "whitespace_height": return $this->data->whitespace_height;
            case "border_width": return $this->data->border_width;
            case "output_options": return $this->data->output_options;
            case "fgcolour": return new string_($this->data->fgcolour);
            case "bgcolour": return new string_($this->data->bgcolour);
            case "fgcolor": return new string_($this->data->fgcolor);
            case "bgcolor": return new string_($this->data->bgcolor);
            case "outfile": return new string_($this->data->outfile);
            case "primary": return new string_($this->data->primary);
            case "option_1": return $this->data->option_1;
            case "option_2": return $this->data->option_2;
            case "option_3": return $this->data->option_3;
            case "show_hrt": return $this->data->show_hrt;
            case "fontsize": return $this->data->fontsize;
            case "input_mode": return $this->data->input_mode;
            case "eci": return $this->data->eci;
            case "dpmm": return $this->data->dpmm;
            case "dot_size": return $this->data->dot_size;
            case "text_gap": return $this->data->text_gap;
            case "guard_descent": return $this->data->guard_descent;
            case "structapp": return new struct_zint_structapp($this->data->structapp);
            case "warn_level": return $this->data->warn_level;
            case "debug": return $this->data->debug;
            case "text": return new unsigned_char_ptr($this->data->text);
            case "rows": return $this->data->rows;
            case "width": return $this->data->width;
            case "encoded_data": return new unsigned_char_ptr_ptr($this->data->encoded_data);
            case "row_height": return new float_ptr($this->data->row_height);
            case "errtxt": return new string_($this->data->errtxt);
            case "bitmap": return new unsigned_char_ptr($this->data->bitmap);
            case "bitmap_width": return $this->data->bitmap_width;
            case "bitmap_height": return $this->data->bitmap_height;
            case "alphamap": return new unsigned_char_ptr($this->data->alphamap);
            case "bitmap_byte_length": return $this->data->bitmap_byte_length;
            case "vector": return new struct_zint_vector_ptr($this->data->vector);
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function __set($prop, $value) {
        switch ($prop) {
            case "symbology":
                $this->data->symbology = $value;
                return;
            case "height":
                $this->data->height = $value;
                return;
            case "scale":
                $this->data->scale = $value;
                return;
            case "whitespace_width":
                $this->data->whitespace_width = $value;
                return;
            case "whitespace_height":
                $this->data->whitespace_height = $value;
                return;
            case "border_width":
                $this->data->border_width = $value;
                return;
            case "output_options":
                $this->data->output_options = $value;
                return;
            case "fgcolour":
                (new string_($this->data->fgcolour))->set($value);
                return;
            case "bgcolour":
                (new string_($this->data->bgcolour))->set($value);
                return;
            case "fgcolor":
                (new string_($this->data->fgcolor))->set($value);
                return;
            case "bgcolor":
                (new string_($this->data->bgcolor))->set($value);
                return;
            case "outfile":
                (new string_($this->data->outfile))->set($value);
                return;
            case "primary":
                (new string_($this->data->primary))->set($value);
                return;
            case "option_1":
                $this->data->option_1 = $value;
                return;
            case "option_2":
                $this->data->option_2 = $value;
                return;
            case "option_3":
                $this->data->option_3 = $value;
                return;
            case "show_hrt":
                $this->data->show_hrt = $value;
                return;
            case "fontsize":
                $this->data->fontsize = $value;
                return;
            case "input_mode":
                $this->data->input_mode = $value;
                return;
            case "eci":
                $this->data->eci = $value;
                return;
            case "dpmm":
                $this->data->dpmm = $value;
                return;
            case "dot_size":
                $this->data->dot_size = $value;
                return;
            case "text_gap":
                $this->data->text_gap = $value;
                return;
            case "guard_descent":
                $this->data->guard_descent = $value;
                return;
            case "structapp":
                (new struct_zint_structapp($this->data->structapp))->set($value);
                return;
            case "warn_level":
                $this->data->warn_level = $value;
                return;
            case "debug":
                $this->data->debug = $value;
                return;
            case "text":
                (new unsigned_char_ptr($this->data->text))->set($value);
                return;
            case "rows":
                $this->data->rows = $value;
                return;
            case "width":
                $this->data->width = $value;
                return;
            case "encoded_data":
                (new unsigned_char_ptr_ptr($this->data->encoded_data))->set($value);
                return;
            case "row_height":
                (new float_ptr($this->data->row_height))->set($value);
                return;
            case "errtxt":
                (new string_($this->data->errtxt))->set($value);
                return;
            case "bitmap":
                (new unsigned_char_ptr($this->data->bitmap))->set($value);
                return;
            case "bitmap_width":
                $this->data->bitmap_width = $value;
                return;
            case "bitmap_height":
                $this->data->bitmap_height = $value;
                return;
            case "alphamap":
                (new unsigned_char_ptr($this->data->alphamap))->set($value);
                return;
            case "bitmap_byte_length":
                $this->data->bitmap_byte_length = $value;
                return;
            case "vector":
                (new struct_zint_vector_ptr($this->data->vector))->set($value);
                return;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function set(struct_zint_symbol $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_symbol'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
/**
 * @property int $symbology
 * @property float $height
 * @property float $scale
 * @property int $whitespace_width
 * @property int $whitespace_height
 * @property int $border_width
 * @property int $output_options
 * @property string_ $fgcolour
 * @property string_ $bgcolour
 * @property string_ $fgcolor
 * @property string_ $bgcolor
 * @property string_ $outfile
 * @property string_ $primary
 * @property int $option_1
 * @property int $option_2
 * @property int $option_3
 * @property int $show_hrt
 * @property int $fontsize
 * @property int $input_mode
 * @property int $eci
 * @property float $dpmm
 * @property float $dot_size
 * @property float $text_gap
 * @property float $guard_descent
 * @property struct_zint_structapp $structapp
 * @property int $warn_level
 * @property int $debug
 * @property unsigned_char_ptr $text
 * @property int $rows
 * @property int $width
 * @property unsigned_char_ptr_ptr $encoded_data
 * @property float_ptr $row_height
 * @property string_ $errtxt
 * @property unsigned_char_ptr $bitmap
 * @property int $bitmap_width
 * @property int $bitmap_height
 * @property unsigned_char_ptr $alphamap
 * @property int $bitmap_byte_length
 * @property struct_zint_vector_ptr $vector
 */
class struct_zint_symbol_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_symbol_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_symbol_ptr_ptr { return new struct_zint_symbol_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_symbol { return new struct_zint_symbol($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_symbol { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_symbol[] */ public function toArray(int $length): array { $ret = []; for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_symbol($this->data[$i]); } return $ret; }
    public function __get($prop) {
        switch ($prop) {
            case "symbology": return $this->data[0]->symbology;
            case "height": return $this->data[0]->height;
            case "scale": return $this->data[0]->scale;
            case "whitespace_width": return $this->data[0]->whitespace_width;
            case "whitespace_height": return $this->data[0]->whitespace_height;
            case "border_width": return $this->data[0]->border_width;
            case "output_options": return $this->data[0]->output_options;
            case "fgcolour": return new string_($this->data[0]->fgcolour);
            case "bgcolour": return new string_($this->data[0]->bgcolour);
            case "fgcolor": return new string_($this->data[0]->fgcolor);
            case "bgcolor": return new string_($this->data[0]->bgcolor);
            case "outfile": return new string_($this->data[0]->outfile);
            case "primary": return new string_($this->data[0]->primary);
            case "option_1": return $this->data[0]->option_1;
            case "option_2": return $this->data[0]->option_2;
            case "option_3": return $this->data[0]->option_3;
            case "show_hrt": return $this->data[0]->show_hrt;
            case "fontsize": return $this->data[0]->fontsize;
            case "input_mode": return $this->data[0]->input_mode;
            case "eci": return $this->data[0]->eci;
            case "dpmm": return $this->data[0]->dpmm;
            case "dot_size": return $this->data[0]->dot_size;
            case "text_gap": return $this->data[0]->text_gap;
            case "guard_descent": return $this->data[0]->guard_descent;
            case "structapp": return new struct_zint_structapp($this->data[0]->structapp);
            case "warn_level": return $this->data[0]->warn_level;
            case "debug": return $this->data[0]->debug;
            case "text": return new unsigned_char_ptr($this->data[0]->text);
            case "rows": return $this->data[0]->rows;
            case "width": return $this->data[0]->width;
            case "encoded_data": return new unsigned_char_ptr_ptr($this->data[0]->encoded_data);
            case "row_height": return new float_ptr($this->data[0]->row_height);
            case "errtxt": return new string_($this->data[0]->errtxt);
            case "bitmap": return new unsigned_char_ptr($this->data[0]->bitmap);
            case "bitmap_width": return $this->data[0]->bitmap_width;
            case "bitmap_height": return $this->data[0]->bitmap_height;
            case "alphamap": return new unsigned_char_ptr($this->data[0]->alphamap);
            case "bitmap_byte_length": return $this->data[0]->bitmap_byte_length;
            case "vector": return new struct_zint_vector_ptr($this->data[0]->vector);
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function __set($prop, $value) {
        switch ($prop) {
            case "symbology":
                $this->data[0]->symbology = $value;
                return;
            case "height":
                $this->data[0]->height = $value;
                return;
            case "scale":
                $this->data[0]->scale = $value;
                return;
            case "whitespace_width":
                $this->data[0]->whitespace_width = $value;
                return;
            case "whitespace_height":
                $this->data[0]->whitespace_height = $value;
                return;
            case "border_width":
                $this->data[0]->border_width = $value;
                return;
            case "output_options":
                $this->data[0]->output_options = $value;
                return;
            case "fgcolour":
                (new string_($this->data[0]->fgcolour))->set($value);
                return;
            case "bgcolour":
                (new string_($this->data[0]->bgcolour))->set($value);
                return;
            case "fgcolor":
                (new string_($this->data[0]->fgcolor))->set($value);
                return;
            case "bgcolor":
                (new string_($this->data[0]->bgcolor))->set($value);
                return;
            case "outfile":
                (new string_($this->data[0]->outfile))->set($value);
                return;
            case "primary":
                (new string_($this->data[0]->primary))->set($value);
                return;
            case "option_1":
                $this->data[0]->option_1 = $value;
                return;
            case "option_2":
                $this->data[0]->option_2 = $value;
                return;
            case "option_3":
                $this->data[0]->option_3 = $value;
                return;
            case "show_hrt":
                $this->data[0]->show_hrt = $value;
                return;
            case "fontsize":
                $this->data[0]->fontsize = $value;
                return;
            case "input_mode":
                $this->data[0]->input_mode = $value;
                return;
            case "eci":
                $this->data[0]->eci = $value;
                return;
            case "dpmm":
                $this->data[0]->dpmm = $value;
                return;
            case "dot_size":
                $this->data[0]->dot_size = $value;
                return;
            case "text_gap":
                $this->data[0]->text_gap = $value;
                return;
            case "guard_descent":
                $this->data[0]->guard_descent = $value;
                return;
            case "structapp":
                (new struct_zint_structapp($this->data[0]->structapp))->set($value);
                return;
            case "warn_level":
                $this->data[0]->warn_level = $value;
                return;
            case "debug":
                $this->data[0]->debug = $value;
                return;
            case "text":
                (new unsigned_char_ptr($this->data[0]->text))->set($value);
                return;
            case "rows":
                $this->data[0]->rows = $value;
                return;
            case "width":
                $this->data[0]->width = $value;
                return;
            case "encoded_data":
                (new unsigned_char_ptr_ptr($this->data[0]->encoded_data))->set($value);
                return;
            case "row_height":
                (new float_ptr($this->data[0]->row_height))->set($value);
                return;
            case "errtxt":
                (new string_($this->data[0]->errtxt))->set($value);
                return;
            case "bitmap":
                (new unsigned_char_ptr($this->data[0]->bitmap))->set($value);
                return;
            case "bitmap_width":
                $this->data[0]->bitmap_width = $value;
                return;
            case "bitmap_height":
                $this->data[0]->bitmap_height = $value;
                return;
            case "alphamap":
                (new unsigned_char_ptr($this->data[0]->alphamap))->set($value);
                return;
            case "bitmap_byte_length":
                $this->data[0]->bitmap_byte_length = $value;
                return;
            case "vector":
                (new struct_zint_vector_ptr($this->data[0]->vector))->set($value);
                return;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function set(void_ptr | struct_zint_symbol_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_symbol*'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_symbol_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_symbol_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_symbol_ptr_ptr_ptr { return new struct_zint_symbol_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_symbol_ptr { return new struct_zint_symbol_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_symbol_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_symbol_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_symbol_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_symbol_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_symbol_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_symbol**'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_symbol_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_symbol_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_symbol_ptr_ptr_ptr_ptr { return new struct_zint_symbol_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_symbol_ptr_ptr { return new struct_zint_symbol_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_symbol_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_symbol_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_symbol_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_symbol_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_symbol_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_symbol***'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_symbol_ptr_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_symbol_ptr_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_symbol_ptr_ptr_ptr_ptr_ptr { return new struct_zint_symbol_ptr_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_symbol_ptr_ptr_ptr { return new struct_zint_symbol_ptr_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_symbol_ptr_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_symbol_ptr_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_symbol_ptr_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_symbol_ptr_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_symbol_ptr_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_symbol****'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
/**
 * @property unsigned_char_ptr $source
 * @property int $length
 * @property int $eci
 */
class struct_zint_seg implements iZint {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_seg $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_seg_ptr { return new struct_zint_seg_ptr(FFI::addr($this->data)); }
    public function __get($prop) {
        switch ($prop) {
            case "source": return new unsigned_char_ptr($this->data->source);
            case "length": return $this->data->length;
            case "eci": return $this->data->eci;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function __set($prop, $value) {
        switch ($prop) {
            case "source":
                (new unsigned_char_ptr($this->data->source))->set($value);
                return;
            case "length":
                $this->data->length = $value;
                return;
            case "eci":
                $this->data->eci = $value;
                return;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function set(struct_zint_seg $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_seg'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
/**
 * @property unsigned_char_ptr $source
 * @property int $length
 * @property int $eci
 */
class struct_zint_seg_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_seg_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_seg_ptr_ptr { return new struct_zint_seg_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_seg { return new struct_zint_seg($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_seg { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_seg[] */ public function toArray(int $length): array { $ret = []; for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_seg($this->data[$i]); } return $ret; }
    public function __get($prop) {
        switch ($prop) {
            case "source": return new unsigned_char_ptr($this->data[0]->source);
            case "length": return $this->data[0]->length;
            case "eci": return $this->data[0]->eci;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function __set($prop, $value) {
        switch ($prop) {
            case "source":
                (new unsigned_char_ptr($this->data[0]->source))->set($value);
                return;
            case "length":
                $this->data[0]->length = $value;
                return;
            case "eci":
                $this->data[0]->eci = $value;
                return;
        }
        throw new \Error("Unknown field $prop on type " . self::getType());
    }
    public function set(void_ptr | struct_zint_seg_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_seg*'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_seg_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_seg_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_seg_ptr_ptr_ptr { return new struct_zint_seg_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_seg_ptr { return new struct_zint_seg_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_seg_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_seg_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_seg_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_seg_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_seg_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_seg**'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_seg_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_seg_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_seg_ptr_ptr_ptr_ptr { return new struct_zint_seg_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_seg_ptr_ptr { return new struct_zint_seg_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_seg_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_seg_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_seg_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_seg_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_seg_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_seg***'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class struct_zint_seg_ptr_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(struct_zint_seg_ptr_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): struct_zint_seg_ptr_ptr_ptr_ptr_ptr { return new struct_zint_seg_ptr_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): struct_zint_seg_ptr_ptr_ptr { return new struct_zint_seg_ptr_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): struct_zint_seg_ptr_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return struct_zint_seg_ptr_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new struct_zint_seg_ptr_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new struct_zint_seg_ptr_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | struct_zint_seg_ptr_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'struct zint_seg****'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class unsigned_char_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(unsigned_char_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): unsigned_char_ptr_ptr { return new unsigned_char_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): int { return $this->data[$n]; }
    #[\ReturnTypeWillChange] public function offsetGet($offset): int { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value; }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return int[] */ public function toArray(int $length): array { $ret = []; for ($i = 0; $i < $length; ++$i) { $ret[] = ($this->data[$i]); } return $ret; }
    public function toString(?int $length = null): string { return $length === null ? FFI::string($this->data) : FFI::string($this->data, $length); }
    public static function persistent(string $string): self { $str = new self(FFI::new("unsigned char[" . \strlen($string) . "]", false)); FFI::memcpy($str->data, $string, \strlen($string)); return $str; }
    public static function owned(string $string): self { $str = new self(FFI::new("unsigned char[" . \strlen($string) . "]", true)); FFI::memcpy($str->data, $string, \strlen($string)); return $str; }
    public static function persistentZero(string $string): self { return self::persistent("$string\0"); }
    public static function ownedZero(string $string): self { return self::owned("$string\0"); }
    public function set(int | void_ptr | unsigned_char_ptr $value): void {
        if (\is_scalar($value)) {
            $this->data[0] = $value;
        } else {
            FFI::addr($this->data)[0] = $value->getData();
        }
    }
    public static function getType(): string { return 'unsigned_char*'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class unsigned_char_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(unsigned_char_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): unsigned_char_ptr_ptr_ptr { return new unsigned_char_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): unsigned_char_ptr { return new unsigned_char_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): unsigned_char_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return unsigned_char_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new unsigned_char_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new unsigned_char_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | unsigned_char_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'unsigned_char**'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class unsigned_char_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(unsigned_char_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): unsigned_char_ptr_ptr_ptr_ptr { return new unsigned_char_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): unsigned_char_ptr_ptr { return new unsigned_char_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): unsigned_char_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return unsigned_char_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new unsigned_char_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new unsigned_char_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | unsigned_char_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'unsigned_char***'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class unsigned_char_ptr_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(unsigned_char_ptr_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): unsigned_char_ptr_ptr_ptr_ptr_ptr { return new unsigned_char_ptr_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): unsigned_char_ptr_ptr_ptr { return new unsigned_char_ptr_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): unsigned_char_ptr_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return unsigned_char_ptr_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new unsigned_char_ptr_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new unsigned_char_ptr_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | unsigned_char_ptr_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'unsigned_char****'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class int_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(int_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): int_ptr_ptr { return new int_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): int { return $this->data[$n]; }
    #[\ReturnTypeWillChange] public function offsetGet($offset): int { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value; }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return int[] */ public function toArray(int $length): array { $ret = []; for ($i = 0; $i < $length; ++$i) { $ret[] = ($this->data[$i]); } return $ret; }
    public function set(int | void_ptr | int_ptr $value): void {
        if (\is_scalar($value)) {
            $this->data[0] = $value;
        } else {
            FFI::addr($this->data)[0] = $value->getData();
        }
    }
    public static function getType(): string { return 'int*'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class int_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(int_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): int_ptr_ptr_ptr { return new int_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): int_ptr { return new int_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): int_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return int_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new int_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new int_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | int_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'int**'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class int_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(int_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): int_ptr_ptr_ptr_ptr { return new int_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): int_ptr_ptr { return new int_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): int_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return int_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new int_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new int_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | int_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'int***'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class int_ptr_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(int_ptr_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): int_ptr_ptr_ptr_ptr_ptr { return new int_ptr_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): int_ptr_ptr_ptr { return new int_ptr_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): int_ptr_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return int_ptr_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new int_ptr_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new int_ptr_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | int_ptr_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'int****'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class unsigned_int_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(unsigned_int_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): unsigned_int_ptr_ptr { return new unsigned_int_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): int { return $this->data[$n]; }
    #[\ReturnTypeWillChange] public function offsetGet($offset): int { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value; }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return int[] */ public function toArray(int $length): array { $ret = []; for ($i = 0; $i < $length; ++$i) { $ret[] = ($this->data[$i]); } return $ret; }
    public function set(int | void_ptr | unsigned_int_ptr $value): void {
        if (\is_scalar($value)) {
            $this->data[0] = $value;
        } else {
            FFI::addr($this->data)[0] = $value->getData();
        }
    }
    public static function getType(): string { return 'unsigned_int*'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class unsigned_int_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(unsigned_int_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): unsigned_int_ptr_ptr_ptr { return new unsigned_int_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): unsigned_int_ptr { return new unsigned_int_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): unsigned_int_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return unsigned_int_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new unsigned_int_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new unsigned_int_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | unsigned_int_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'unsigned_int**'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class unsigned_int_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(unsigned_int_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): unsigned_int_ptr_ptr_ptr_ptr { return new unsigned_int_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): unsigned_int_ptr_ptr { return new unsigned_int_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): unsigned_int_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return unsigned_int_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new unsigned_int_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new unsigned_int_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | unsigned_int_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'unsigned_int***'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class unsigned_int_ptr_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(unsigned_int_ptr_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): unsigned_int_ptr_ptr_ptr_ptr_ptr { return new unsigned_int_ptr_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): unsigned_int_ptr_ptr_ptr { return new unsigned_int_ptr_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): unsigned_int_ptr_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return unsigned_int_ptr_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new unsigned_int_ptr_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new unsigned_int_ptr_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | unsigned_int_ptr_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'unsigned_int****'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class float_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(float_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): float_ptr_ptr { return new float_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): float { return $this->data[$n] + 0.0; }
    #[\ReturnTypeWillChange] public function offsetGet($offset): float { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value; }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return float[] */ public function toArray(int $length): array { $ret = []; for ($i = 0; $i < $length; ++$i) { $ret[] = ($this->data[$i]); } return $ret; }
    public function set(float | void_ptr | float_ptr $value): void {
        if (\is_scalar($value)) {
            $this->data[0] = $value;
        } else {
            FFI::addr($this->data)[0] = $value->getData();
        }
    }
    public static function getType(): string { return 'float*'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class float_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(float_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): float_ptr_ptr_ptr { return new float_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): float_ptr { return new float_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): float_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return float_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new float_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new float_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | float_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'float**'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class float_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(float_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): float_ptr_ptr_ptr_ptr { return new float_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): float_ptr_ptr { return new float_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): float_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return float_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new float_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new float_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | float_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'float***'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}
class float_ptr_ptr_ptr_ptr implements iZint, iZint_ptr, \ArrayAccess {
    private FFI\CData $data;
    public function __construct(FFI\CData $data) { $this->data = $data; }
    public static function castFrom(iZint $data): self { return Zint::cast($data, self::class); }
    public function getData(): FFI\CData { return $this->data; }
    public function equals(float_ptr_ptr_ptr_ptr $other): bool { return $this->data == $other->data; }
    public function addr(): float_ptr_ptr_ptr_ptr_ptr { return new float_ptr_ptr_ptr_ptr_ptr(FFI::addr($this->data)); }
    public function deref(int $n = 0): float_ptr_ptr_ptr { return new float_ptr_ptr_ptr($this->data[$n]); }
    #[\ReturnTypeWillChange] public function offsetGet($offset): float_ptr_ptr_ptr { return $this->deref($offset); }
    #[\ReturnTypeWillChange] public function offsetExists($offset): bool { return !FFI::isNull($this->data); }
    #[\ReturnTypeWillChange] public function offsetUnset($offset): void { throw new \Error("Cannot unset C structures"); }
    #[\ReturnTypeWillChange] public function offsetSet($offset, $value): void { $this->data[$offset] = $value->getData(); }
    public static function array(int $size = 1): self { return Zint::makeArray(self::class, $size); }
    /** @return float_ptr_ptr_ptr[] */ public function toArray(?int $length = null): array { $ret = []; if ($length === null) { $i = 0; while (null !== $cur = $this->data[$i++]) { $ret[] = new float_ptr_ptr_ptr($cur); } } else { for ($i = 0; $i < $length; ++$i) { $ret[] = new float_ptr_ptr_ptr($this->data[$i]); } } return $ret; }
    public function set(void_ptr | float_ptr_ptr_ptr_ptr $value): void {
        FFI::addr($this->data)[0] = $value->getData();
    }
    public static function getType(): string { return 'float****'; }
    public static function size(): int { return Zint::sizeof(self::class); }
    public function getDefinition(): string { return static::getType(); }
}